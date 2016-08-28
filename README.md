# dokuwiki-katex

## Overview
This plugin adds [KaTeX](https://github.com/Khan/KaTeX) support to your wiki pages. KaTeX is a fast, high-quality Javascript library for typesetting LaTeX mathematics within webpages, it performs better than MathJax but is still under early development.

## Usage
This plugin operates in two modes for KaTeX typesetting: inline and display. Inline mathematics should be surrounded by single `$`s and display expressions should be surrounded by a pair of `$`s.

For example: `$y = mx + c$` displays inline, whilst `$$y = ax^2 + bx + c$$` will be displayed as display mathematics.

!TOFIX: currently this will break if you have other `$`s in your page.
