# Whistleblower Plugin

The **Whistleblower** Plugin is an extension for [Grav CMS](https://github.com/getgrav/grav).

**Whistleblower** helps you to know what happens on your site everytime by notifying you directly to your phone.

## Installation

Installing the Whistleblower plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](https://learn.getgrav.org/cli-console/grav-cli-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install whistleblower

This will install the Whistleblower plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/whistleblower`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `whistleblower`. You can find these files on [GitHub](https://github.com/himmlisch-studios/grav-plugin-whistleblower) or via [GetGrav.org](https://getgrav.org/downloads/plugins).

You should now have all the plugin files under

    /your/site/grav/user/plugins/whistleblower

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/whistleblower/whistleblower.yaml` to `user/config/plugins/whistleblower.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
admin_mode: true
# custom_server:
# custom_password:
endpoint: ""
events:
    onUserLogin: "Someone has logged on {domain}!"
    onUserLoginFailure: "Failed login attempt at {hour}"
```

Note that if you use the Admin Plugin, a file with your configuration named whistleblower.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

To start using the plugin you need to setup a ntfy endpoint. **Make sure this is unique**, since anyone could guess your endpoint and listen for all notifications.

Once setup, you can start adding any event hooks from Grav or Grav plugins and pairing them with a message you want to receive.

You can use a variety of variables to customize your messages. Such as `{username}` to receive the user who executed the event.

To start listening to the notifications you can either install the NTFY app available at the [F-Droid Store](https://f-droid.org/en/packages/io.heckel.ntfy/) or the [Google Play Store](https://play.google.com/store/apps/details?id=io.heckel.ntfy).

Or you can choose to use the [Web App](https://ntfy.sh/app).

To finish, just add the exact endpoint/topic you setup on the plugin configuration.

## Credits

Thanks to [Philip C. Heckel](https://heckel.io/) and the contributors of [NTFY](https://github.com/binwiederhier/ntfy) for making this service publicly available and free.

## Need a website?

At [Himmlisch Web](https://web.himmlisch.com.mx) we help you to develop the site of your dreams, with the exact functionality and look as you want. [Contact us!](https://himmlisch.com.mx/contact)
