<?php

namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Common\Utils;

/**
 * Class WhistleblowerPlugin
 * @package Grav\Plugin
 */
class WhistleblowerPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        $this->getConfigs();

        if ($this->config['admin_only'] && !$this->isAdmin() || empty($this->configs['endpoint'])) {
            return;
        }

        $this->events = [];

        $site = $this->grav['config']->get('site.title') ?? 'Grav Website';
        $user = $this->grav['user'];
        $server = $this->configs['custom_server'] ?? 'https://ntfy.sh';
        $server = !empty($server) ? $server : 'https://ntfy.sh';
        $variables = [
            '{site}' => $site,
            '{domain}' => $this->grav['uri']->rootUrl(true) ?? '',
            '{username}' => $user !== null ? $user->get('username') ?? '' : '',
            '{date}' => date('m.d.y'),
            '{hour}' => date('g:i A')
        ];

        foreach ($this->configs['events'] as $event => $message) {
            $message = str_replace(
                array_keys($variables),
                $variables,
                $message
            );

            $header = [];
            $header['Title'] = $site;

            if (isset($this->configs['custom_password']) && !empty($this->configs['custom_password'])) {
                $header['Authorization'] = "Basic " . $this->configs['custom_password'];
            }

            $this->events[$event] = fn () => $this->ntfy($this->configs['endpoint'], $message, $header, $server);

            $this->enable([
                $event => [
                    ['executeEvent', $event]
                ]
            ]);
        }
    }

    public function executeEvent($_, String $key): void
    {
        call_user_func($this->events[$key]);
    }

    private function getConfigs(): void
    {
        $this->configs = $this->config->get('plugins.whistleblower');
    }

    private function ntfy(
        String $endpoint,
        String $content,
        array $header = ['Title' => 'Whistleblower ~'],
        String $server = "https://ntfy.sh",
        int $priority = 3
    ): void {
        if (empty($endpoint)) {
            return;
        }
        array_walk($header, fn (&$v, $key) => $v = "$key: $v");

        $ch = curl_init("$server/$endpoint");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
            "Content-Type: text/plain",
            "Priority: $priority"
        ], $header));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);

        curl_exec($ch);
        curl_close($ch);
    }
}
