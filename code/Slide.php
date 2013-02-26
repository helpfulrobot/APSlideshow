<?php

class Slide extends DataObject {

	public static $db = array(
		"Title" => "Varchar(255)",
		"SortOrder" => "Int",
		"GoToURL" => "Text",
		"Draft" => "Boolean"
	);

	public static $has_one = array(
		"Image" => "Image",
		"Page" => "Page"
	);

	static $default_sort = "SortOrder";

	static $field_labels = array(
		"Title" => "Caption"
	);

	static $summary_fields = array(
		"Thumbnail",
		"Title"
	);

	function getThumbnail() {
		if (((int) $this->ImageID > 0) && (is_a($this->Image(),'Image')))  {
			return $this->Image()->SetWidth(50);
		} else {
			return "No thumbnails available";
		}
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		return $fields;
	}

}
