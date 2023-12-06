<?php


class Easycal_i18n {


	public function easycal_load_plugin_textdomain() {

		load_plugin_textdomain(
			'easycal',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/lang/'
		);

	}



}
