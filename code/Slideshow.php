<?php

class Slideshow extends DataExtension {

	public static $has_many = array(
		"Slides" => "Slide"
	);

	public function updateCMSFields(FieldList $fields) {
		$config = GridFieldConfig::create();
		$config->addComponent(new GridFieldToolbarHeader());
		$config->addComponent(new GridFieldAddNewButton("toolbar-header-right"));
		$config->addComponent(new GridFieldDataColumns());
		$config->addComponent(new GridFieldEditButton());
		$config->addComponent(new GridFieldDeleteAction());
		$config->addComponent(new GridFieldDetailForm());
		$config->addComponent(new GridFieldSortableHeader());
		$config->addComponent(new GridFieldOrderableRows("SortOrder"));

		$config->getComponentByType('GridFieldDataColumns')
			->setFieldCasting(array(
				"Draft" => "Boolean->Nice"
			)
		);

		$gridField = new GridField("Slides", "Slides", $this->owner->Slides(), $config);
		$fields->addFieldToTab("Root", new Tab("Slideshow", "Slideshow"));
		$fields->addFieldToTab("Root.Slideshow", $gridField);
		return $fields;
	}

}

class Slideshow_Controller extends SiteTreeExtension {

	public function contentcontrollerInit($controller) {
		if ($this->owner->Slides()) {
			Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.min.js");
			Requirements::javascript("APSlideshow/thirdparty/responsiveslides.js");
			Requirements::javascript("APSlideshow/js/ap.slideshow.js");
			Requirements::css("APSlideshow/css/APSlideshow.css");
		}

	}
}
