<?php

if (!defined("DOKU_INC")) die();

class action_plugin_katex extends DokuWiki_Action_Plugin {
	public function register(Doku_Event_Handler $controller) {
		$controller->register_hook("TPL_METAHEADER_OUTPUT", "BEFORE", $this, "handle_tpl_metaheader_output");
	}
	
	public function handle_tpl_metaheader_output(Doku_Event &$event, $param){
		// Main CSS
		$event->data["link"][] = array(
			"type"		=> "text/css",
			"rel"		=> "stylesheet",
			"href"		=> "https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.6.0/katex.min.css"
		);
		
		// Main JS
		$event->data["script"][] = array(
			"type"		=> "text/javascript",
			"_data"		=> "",
			"src"		=> "https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.6.0/katex.min.js"
		);
		
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