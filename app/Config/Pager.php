<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Templates
     * --------------------------------------------------------------------------
     *
     * Pagination links are rendered out using views to configure their
     * appearance. This array contains aliases and the view names to
     * use when rendering the links.
     *
     * Within each view, the Pager object will be available as $pager,
     * and the desired group as $pagerGroup;
     *
     * @var array<string, string>
     */
    public $templates = [
        'default_full'   => 'CodeIgniter\Pager\Views\default_full',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'default_head'   => 'CodeIgniter\Pager\Views\default_head',
        'pagination_sayur' => 'App\Views\Pagination\pagination_sayur',
        'pagination_tanamanObat' => 'App\Views\Pagination\pagination_tanamanObat',
        'pagination_dataPanen' => 'App\Views\Pagination\pagination_dataPanen',
        'pagination_dataTernak' => 'App\Views\Pagination\pagination_dataTernak',
        'pagination_dataIkan' => 'App\Views\Pagination\pagination_dataIkan',
        'pagination_dataBuah' => 'App\Views\Pagination\pagination_dataBuah',
    ];

    /**
     * --------------------------------------------------------------------------
     * Items Per Page
     * --------------------------------------------------------------------------
     *
     * The default number of results shown in a single page.
     *
     * @var int
     */
    public $perPage = 20;
}
