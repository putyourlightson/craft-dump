Craft Dump
==========

Simple way to create DB backups in Craft CMS.

Install the plugin and set a key in the settings.

Simply create a GET or a POST request to the action url.

In a template:
{{ actionUrl('dump/backup', { key: '1234567890' }) }}

Or create the url yourself:
http://www.domain.com/actions/dump/backup?key=1234567890
