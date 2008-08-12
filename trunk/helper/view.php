<?php

	/**
	 * This is a class which holds the instance variables to be used in a page layout.
	 * variable $R is recommended to be used as its instance.
	 **/
	class view
	{
		/**
		 * All variables must be prefixed with double underscores.
		 * otherwise they will conflict with layout instance variables.
		 */
		protected $__layout_file;
		protected $__view_file;
		
		public function __construct($view_file = '')
		{
			$this->__view_file = $view_file;
		}
		
		public function __set($f, $v)
		{
			if(substr($f, 0, 2) === '__')
				throw new Exception('Instance fields prefixed with double underscores (__) are not allowed.');
			$this->$f = $v;
		}
		
		/**
		 * User can set/change the layout file anytime before calling the show() method.
		 *
		 * == Difference between layout and view
		 * Layouts contain html blocks which are repeatedly used. For exampke the <head> section, headers and footers.
		 * Views contain the code which are specific to each page.
		 */
		public function set_layout($layout_file)
		{
			$this->__layout_file = $layout_file;
		}
		
		/**
		 * User can set/change the view file anytime before calling the show() method.
		 */
		public function set_view($view_file)
		{
			$this->__view_file = $view_file;
		}
		
		/**
		 * Display the page.
		 * Variables can be accessed using $this-> in layouts.
		 *
		 * If a layout is not defined, display only the page.
		 * else display both the layout containing the page.
		 */
		public function show($view_file = '')
		{
			if(!empty($view_file) and isstring($view_file))
				$this->__view_file = $view_file;
			
			if(empty($this->__layout_file))
				require($this->__view_file);
			else
				require($this->__layout_file);
		}
		
		/**
		 * A layout file should call this method, where the view has to be included.
		 */
		private function include_view($view_file = '')
		{
			if(!empty($view_file) and isstring($view_file))
				$this->__view_file = $view_file;
			require($this->__view_file);
		}
	}
?>