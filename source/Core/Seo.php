<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 09/05/2019
 * Time: 11:22
 */

namespace Source\Core;


/**
 * Class Seo
 * @package Source\Core
 */
/**
 * Class Seo
 * @package Source\Core
 */
class Seo
{

    /** @var string */
    private $seo_title;

    /** @var string */
    private $seo_facebook;

    /** @var string */
    private $seo_google;

    /** @var string */
    private $seo_twitter;

    /** @var string */
    private $seo_favicon;


    /**
     * @param $title
     * @return string
     */
    public function title($title): Seo
    {
        $this->seo_title = "<title>{$title}</title>
                            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                            <meta name=\"description\" content='" . SEO_SITE_SUBTITLE . " | " . SEO_SITE_DESCRIPTION . "' />
                            <meta charset=\"utf-8\">
                            <meta name=\"keywords\" content='".SEO_SITE_KEYWORDS."'>
                            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
        return $this;
    }

    /**
     * @param $page_url
     * @param $page_type
     * @param $page_title
     * @param $description
     * @param $path_to_image
     * @return string
     */
    public function facebook($page_url, $page_title, $page_description, $path_to_image, $page_type = "article"): Seo
    {
        $url = "<meta property=\"og:url\" content=\"{$page_url}\" />";
        $type = "<meta property=\"og:type\" content=\"{$page_type}\" />";
        $title = "<meta property=\"og:title\" content=\"{$page_title}\" />";
        $description = "<meta property=\"og:description\" content=\"{$page_description}\" />";
        $site_name = "<meta property=\"og:site_name\" content='" . SEO_SITE_NAME . "' />";
        $fb_admin = "<meta property=\"fb:admins\" content='" . SEO_FB_APP_ID . "' />";
        $image = "<meta property=\"og:image\" content=\"{$path_to_image}\" />";
        $this->seo_facebook = $url . $type . $title . $fb_admin . $description . $site_name . $image;

        return $this;
    }


    /**
     * @param $page_description
     * @param $page_name
     * @param $path_to_image
     * @return string
     */
    public function google($page_description, $page_name, $path_to_image = "", $page_robots = "index, follow"): Seo
    {

        $autor = "<link rel=\"author\" href='" . SEO_SITE_AUTHOR . "' />";
        $publisher = "<link rel=\"publisher\" href='" . SEO_SITE_PUBLISHER . "'/>";
        $name = "<meta itemprop=\"name\" content=\"{$page_name}\">";
        $description_page = "<meta itemprop=\"description\" content=\"{$page_description}\">";
        $robots = "<meta name=\"robots\" content=\"{$page_robots}\" />";
        $image = "<meta itemprop=\"image\" content=\"{$path_to_image}\">";

        $this->seo_google = $descricao . $autor . $publisher . $name . $description_page . $robots . $image;

        return $this;
    }

    /**
     * @param string $twi_account
     * @param string $page_title
     * @param string $page_description
     * @param string $twi_creator
     * @param string $twi_image
     * @return null|string
     */
    public function twitter(string $page_title, string $page_description, string $twi_image): ?Seo
    {

        $summary = "<meta name=\"twitter:card\" content=\"summary_large_image\">";
        $account = "<meta name=\"twitter:site\" content='" . SEO_TWITTER_ACCOUNT . "'>";
        $title = "<meta name=\"twitter:title\" content=\"{$page_title}\">";
        $description = "<meta name=\"twitter:description\" content=\"{$page_description}\">";
        $creator = "<meta name=\"twitter:creator\" content='" . SEO_TWITTER_CREATOR . "'>";
        $image = "<meta name=\"twitter:image\" content=\"{$twi_image}\">";

        $this->seo_twitter = $summary . $account . $title . $description . $creator . $image;

        return $this;

    }

    /**
     * @return Seo
     */
    public function favicon():Seo
    {
        $favicon = "<link rel=\"shortcut icon\" href='".url(SEO_SITE_FAVICON)."'>";
        $this->seo_favicon = $favicon;
        return $this;
    }

    /**
     * @return null|string
     */
    public function render(): ?string
    {
        $render = "";

        if (isset($this->seo_title)) {
            $render .= $this->seo_title;
        }

        if (isset($this->seo_facebook)) {
            $render .= $this->seo_facebook;
        }

        if (isset($this->seo_google)) {
            $render .= $this->seo_google;
        }

        if (isset($this->seo_twitter)) {
            $render .= $this->seo_twitter;
        }

        if (isset($this->seo_favicon)) {
            $render .= $this->seo_favicon;
        }

        return $render;
    }

}