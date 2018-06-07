<?php

namespace Automations;

use Composer\Script\Event;

class Automate {
	public static function build(Event $event) {
		//$composer = $event->getComposer();

		if (!is_dir('lib')) {
			mkdir('lib', 0775);
		}

		//Font Awesome
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/bower_components/font-awesome/css/font-awesome.min.css', 'lib/font-awesome/css/font-awesome.min.css');
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/bower_components/font-awesome/fonts/fontawesome-webfont.woff', 'lib/font-awesome/fonts/fontawesome-webfont.woff');
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/bower_components/font-awesome/fonts/fontawesome-webfont.ttf', 'lib/font-awesome/fonts/fontawesome-webfont.ttf');

		//jQuery
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/bower_components/jquery/dist/jquery.min.js', 'lib/jquery/jquery.min.js');

		//Bootstrap
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/bower_components/bootstrap/dist/css/bootstrap.min.css', 'lib/bootstrap/bootstrap.min.css');
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/bower_components/bootstrap/dist/js/bootstrap.min.js', 'lib/bootstrap/bootstrap.min.js');

		//Metis Menu
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.js', 'lib/metis-menu/metisMenu.min.js');
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.css', 'lib/metis-menu/metisMenu.min.css');

		//SB Admin
		Automate::copy('vendor/iron-summit-media/startbootstrap-sb-admin-2/dist/js/sb-admin-2.js', 'lib/sb-admin/sb-admin-2.js');
	}

	public static function copy($s1, $s2) {
		$path = pathinfo($s2);
		if (!file_exists($path['dirname'])) {
			mkdir($path['dirname'], 0777, true);
		}
		if (!copy($s1, $s2)) {
			echo "copy failed \n";
		}
	}
}
