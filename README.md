## Shopware Simple Theme
(THE PLUGIN IS UNDER DEVELOPMENT AND SHOULD NOT BE USED IN PRODUCTION)



- **License**: GPL-3.0
- **Gitea**: https://github.com/juan-k-m/SW5-Theme.git

### Requirements
- Shopware 5.2.25 or newer

### Overview

The repository contains just 'master' branch


### Installation via Shopware Store

not available

### Installation via Git
1.) go to your shop root directory, then go to -> plugins directory and there create a new folder named 'JkTheme'and run in the command line:

```
git clone https://github.com/juan-k-m/SW5-Theme.git .

```

2.) install the plugin in the plugin manager or execute the following commands on the command line
```
php bin/console sw:plugin:refresh
php bin/console sw:plugin:install --activate JkTheme
php bin/console sw:cache:clear


```
