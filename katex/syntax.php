<?php

if (!defined("DOKU_INC")) die();

class syntax_plugin_katex extends DokuWiki_Syntax_Plugin {
	public function getType() {
		return "protected";
	}
	
	public function getSort() {
		return 65;
	}
	
	public function connectTo($mode) {
		$this->Lexer->addSpecialPattern("\\$+.+?\\$(?!\\$)", $mode, "plugin_katex");
	}
	
	public function handle($match, $state, $pos, Doku_Handler &$handler) {
		$match = str_replace('<=>', ' \Leftrightarrow ', $match);
        $match = str_replace('<->', ' \leftrightarrow ', $match);
        $match = str_replace('->', ' \rightarrow ', $match);
        $match = str_replace('<-', ' \leftarrow ', $match);
        $match = str_replace('=>', ' \Rightarrow ', $match);
        $match = str_replace('<=', ' \Leftarrow ', $match);
        $match = str_replace('...', ' \ldots ', $match);
        $match = str_replace('−', '-', $match);
		
		return $match;
	}
	
	public function render($mode, Doku_Renderer &$renderer, $data) {
		if ($mode == "xhtml" || $mode == "odt") {
			$renderer->doc .= "<span class='math'>".$renderer->_xmlEntities($data)."</span>";
			return true;
		}
		
		if ($mode == "latex") {
			$renderer->doc .= $data;
			return true;
		}
		
		return false;
	}
}

?>