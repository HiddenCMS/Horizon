<?php
/**
 * Versatile front theme for HiddenCMS.
 */

namespace HB\Themes\Horizon;

use HB\HiddenCMS\Addons\Theme;

class Horizon extends Theme
{
	protected function __info()
	{
		return [
			'title'       => 'Horizon',
			'description' => 'Thème polyvalent et moderne pour HiddenCMS',
			'link'        => 'https://github.com/HiddenCMS/Core',
			'author'      => 'HiddenCMS <contact@hiddenblob.com>',
			'license'     => 'GPL-3.0-only',
			'version'     => '0.1.0',
			'depends'     => ['HiddenCMS' => '0.3.0'],
			'zones'       => ['Haut', 'Identité', 'Navigation', 'Couverture', 'Avant-contenu', 'Contenu', 'Après-contenu', 'Pied de page'],
			'regions'     => [
				'top'            => 'Haut',
				'header'         => 'Identité',
				'navigation'     => 'Navigation',
				'hero'           => 'Couverture',
				'before_content' => 'Avant-contenu',
				'content'        => 'Contenu',
				'after_content'  => 'Après-contenu',
				'footer'         => 'Pied de page'
			]
		];
	}

	public function __init()
	{
		$this	->css('bootstrap.min')
				->css('icons/fontawesome.min')
				->css('fonts/open-sans')
				->css('fonts/titillium-web')
				->css('style')
				->js('jquery-3.2.1.min')
				->js('popper.min')
				->js('bootstrap.min')
				->js('modal')
				->js('notify')
				->js('horizon');
	}

	public function styles_row()
	{
		// Visual variants will be added once the base theme is validated.
	}

	public function styles_widget()
	{
		// Visual variants will be added once the base theme is validated.
	}

	public function install($dispositions = [])
	{
		$this	->config('horizon_accent_color', '#087f8b')
				->config('horizon_secondary_color', '#c96f5b')
				->config('horizon_text_color', '#202c36')
				->config('horizon_background_color', '#f4f6f5')
				->config('horizon_content_width', '1180');

		$dispositions = $this->array();

		$dispositions->set('*', 'Haut', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget' => 'user',
					'type'   => 'index_mini'
				])))->size('col-12')
			)->style('horizon-user-row')
		]));

		$dispositions->set('*', 'Identité', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget'   => 'header',
					'type'     => 'index',
					'settings' => $this->storage->encode([
						'display'           => 'logo',
						'align'             => 'text-left',
						'title'             => '',
						'description'       => '',
						'color_title'       => '',
						'color_description' => ''
					])
				])))->size('col-12')
			)->style('align-items-center')
		]));

		$dispositions->set('*', 'Navigation', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget'   => 'navigation',
					'type'     => 'index',
					'settings' => $this->storage->encode([
						'links' => [[
							'title' => utf8_htmlentities($this->lang('Accueil')),
							'url'   => ''
						]]
					])
				])))->size('col-8'),
				$this->col($this->widget($this->db->insert('widgets', [
					'widget' => 'search',
					'type'   => 'index'
				])))->size('col-4')
			)->style('align-items-center')
		]));

		$dispositions->set('*', 'Contenu', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget' => 'module',
					'type'   => 'index'
				])))->size('col-12')
			)
		]));

		$dispositions->set('*', 'Pied de page', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget' => 'copyright',
					'type'   => 'index'
				]))->style('card-transparent'))->size('col-12')
			)
		]));

		return parent::install($dispositions);
	}

	public function uninstall($remove = TRUE)
	{
		foreach (['accent_color', 'secondary_color', 'text_color', 'background_color', 'content_width'] as $key)
		{
			$this->config->unset('horizon_'.$key);
		}

		return parent::uninstall($remove);
	}
}
