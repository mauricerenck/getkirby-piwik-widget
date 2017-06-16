# Kirby Piwik Widget

This is a (currently) very rudimentary widget for your Kirby-Panel. It shows you current Piwik-Stats of your site.
I will add more functionality and a more beautiful look step by step.

![sample](https://raw.githubusercontent.com/mauricerenck/getkirby-piwik-widget/master/piwik-dash-sample.png)

## Installation
1. Go to the plugin-folder `/site/widgets` (if the folder doesn't exist, create it)
2. get the plugin using 
    - Git: `git submodule add https://github.com/mauricerenck/getkirby-piwik-widget.git piwik-widget`
    - Download: Download it from GitHub, unzip to plugin-folder, make sure to name the directory `piwik-widget`

## Configuration
You have to set three values in your config.php

`c::set('piwik_token', 'xxxxxxxxxxxxxxx');`

`c::set('piwik_baseUrl', 'http://your.piwik-url.tld/');`

`c::set('piwik_siteId', '1');`

To find your Piwik-Token, login to Piwik, click on your personal-settings (user-icon top-right), then click on "API", copy your token (without &token_auth=).
Set the base-url to the URL piwik is available via web
Set the site id to the site you want to see reportings of.

That is it for now.
More options and possibilities will follow.
