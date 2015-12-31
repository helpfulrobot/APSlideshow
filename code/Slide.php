<?php

class Slide extends DataObject
{

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

    public static $default_sort = "SortOrder";

    public static $field_labels = array(
        "Title" => "Caption"
    );

    public static $summary_fields = array(
        "Thumbnail",
        "Title",
        "Draft"
    );

    public function getThumbnail()
    {
        if (((int) $this->ImageID > 0) && (is_a($this->Image(), 'Image'))) {
            return $this->Image()->SetWidth(50);
        } else {
            return "No thumbnails available";
        }
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeFieldsFromTab('Root.Main',
                array(
                    'SortOrder',
                    'Draft',
                    'PageID'
                )
            );

        $fields->addFieldToTab("Root.Main", TextField::create("Title")
                ->setTitle("Caption"));

        $fields->addFieldToTab("Root.Main", TextField::create("GoToURL")
                ->setTitle("Go to URL")
                ->setDescription("Start with http://"));

        $fields->addFieldToTab("Root.Main", FieldGroup::create(
                CheckboxField::create("Draft")->setTitle("Draft?")
            )->setTitle("Draft"));

        $fields->addFieldToTab("Root.Main", UploadField::create("Image")
                ->setTitle("Image")
                ->setFolderName("APSlideshow")
                ->setConfig("allowedMaxFileNumber", 1));

        return $fields;
    }
}
