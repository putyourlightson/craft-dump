Craft Dump for Craft CMS 2
==========

Simple way to create DB backups in Craft CMS 2.

Install the plugin and set a key in the settings.

Simply create a GET or a POST request to the action url.

In a template:

    {{ siteUrl(craft.config.get('actionTrigger') ~ '/dump/backup', { key: '1234567890' }) }}

Or create the url yourself:
http://www.domain.com/actions/dump/backup?key=1234567890
