# Hako

Stupidly simple self-hosted web page archiving tool written in PHP.

## Features

- Archive web pages instantly using a bookmarklet
- Readability functionality
- Basic password protection

## Dependencies

- [Monolith](https://github.com/Y2Z/monolith)
- PHP
- php-xml
- php-mbstring
- Git (optional)

Hako is designed to work out of the box on Linux. With a bit of tweaking, it's possible to make it run on Windows and macOS.

## Installation and usage

Install PHP as well as the _php-xml_ and _php-mbstring_ packages on your system. Clone then the project's Git repository using the `git clone https://github.com/dmpop/hako.git` command. Switch to the resulting _hako_ directory, open the _index.php_ file for editing, and replace the default value of the `$password` variable with the desired password. Save the changes and start the PHP server using the `php -S 0.0.0.0:3000` command.

Instead of using the **Add** button and specifying the URL and title of the web page you want to archive, you can add the following bookmarklet to the bookmark toolbar of your browser (replace _127.0.0.1_ with the actual IP address of the machine running Hako and _password_ with the string that matches the value of the `$password` variable):

    javascript:var%20title=window.getSelection();location.href='http://127.0.0.1:8000/index.php?url='+encodeURIComponent(location.href)+'&title='+'&password=secret

You can navigate to the page you want to archive, select the title, and click on the Hako bookmarklet. If the page has been archived successfully, you should see it in the list of saved pages.

If everything works properly, you might want to create a system service to start Hako automatically. Run the `sudo nano /etc/systemd/system/hako.service` command and add the following definition (replace _/path/to/hako_ with the actual path to the _hako_ directory):

```conf
[Unit]
Description=Hako
Wants=syslog.service

[Service]
Restart=always
ExecStart=/usr/bin/php -S 0.0.0.0:3000 -t /path/to/hako
ExecStop=/usr/bin/kill -HUP $MAINPID

[Install]
WantedBy=multi-user.target
```

Enable and start the service:

```bash
sudo systemctl enable hako.service
sudo systemctl start hako.service
```

## Problems?

Please report bugs and issues in the [Issues](https://github.com/dmpop/hako/issues) section.

## Contribute

If you've found a bug or have a suggestion for improvement, open an issue in the [Issues](https://github.com/dmpop/hako/issues) section.

To add a new feature or fix issues yourself, follow the following steps.

1. Fork the project's repository.
2. Create a feature branch using the `git checkout -b new-feature` command.
3. Add your new feature or fix bugs and run the `git commit -am 'Add a new feature'` command to commit changes.
4. Push changes using the `git push origin new-feature` command.
5. Submit a merge request.

## Author

[Dmitri Popov](https://www.tokyoma.de/)

# License

The [GNU General Public License version 3](http://www.gnu.org/licenses/gpl-3.0.en.html)
