<?php
/**
 * DokuWiki Plugin KaTeX renderer (Action Component)
 */

// must be run within Dokuwiki
if (!defined("DOKU_INC")) die();

if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
define('DOKU_PLUGIN_KATEX',DOKU_BASE.'lib/plugins/'.basename(dirname(__FILE__)).'/');

class action_plugin_katex extends DokuWiki_Action_Plugin {
	public function register(Doku_Event_Handler $controller) {
		$controller->register_hook("TPL_METAHEADER_OUTPUT", "BEFORE", $this, "handle_tpl_metaheader_output");
	}
	
	public function handle_tpl_metaheader_output(Doku_Event &$event, $param){
		if ($this->getConf('cdn')){
			$cdnlink = $this -> getConf('cdnlink');

			// Main CSS
			$event->data["link"][] = array(
				"type"		=> "text/css",
				"rel"		=> "stylesheet",
				"href"		=> $cdnlink."katex.min.css"
			);

			// Main JS
			$event->data["script"][] = array(
				"type"		=> "text/javascript",
				"_data"		=> "",
				"src"		=> $cdnlink."katex.min.js"
			);
		} else {
			// Main CSS
			$event->data["link"][] = array(
				"type"		=> "text/css",
				"rel"		=> "stylesheet",
				"href"		=> DOKU_PLUGIN_KATEX."lib/katex/katex.min.css"
			);
			
			// Main JS
			$event->data["script"][] = array(
				"type"		=> "text/javascript",
				"_data"		=> "",
				"src"		=> DOKU_PLUGIN_KATEX."lib/katex/katex.min.js"
			);
		}

		// Render all katex elements
		$event->data["script"][] = array(
			"type"		=> "text/javascript",
			"_data"		=> 
			"window.onload = function() {
				var elements = document.getElementsByClassName(\"math\");
				for (var i = 0; i < elements.length; ++i) {
					var el = elements[i];
					katex.render(
						el.textContent.replace(/^[\\$]+|[\\$]+$/g, \"\"),
						el, { displayMode: el.textContent[1] == \"$\" }
					);
				}
			}",
		);
	}
}

?>
