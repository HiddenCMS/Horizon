<?php
/**
 * Horizon theme settings.
 */

namespace HB\Themes\Horizon\Controllers;

use HB\HiddenCMS\Loadables\Controller;

class Admin extends Controller
{
	public function index()
	{
		$form = $this->form2()
			->rule($this->form_colorpicker('accent_color')->title($this->lang('Couleur principale'))->value($this->config->horizon_accent_color ?: '#087f8b')->required())
			->rule($this->form_colorpicker('secondary_color')->title($this->lang('Couleur secondaire'))->value($this->config->horizon_secondary_color ?: '#c96f5b')->required())
			->rule($this->form_colorpicker('text_color')->title($this->lang('Couleur du texte'))->value($this->config->horizon_text_color ?: '#202c36')->required())
			->rule($this->form_colorpicker('background_color')->title($this->lang('Couleur de fond'))->value($this->config->horizon_background_color ?: '#f4f6f5')->required())
			->rule($this->form_select('content_width')
				->title($this->lang('Largeur du contenu'))
				->data([
					'1040' => $this->lang('Compacte'),
					'1180' => $this->lang('Standard'),
					'1320' => $this->lang('Large')
				])
				->value($this->config->horizon_content_width ?: '1180')
				->required())
			->success(function($data){
				$this	->config('horizon_accent_color', $data['accent_color'])
						->config('horizon_secondary_color', $data['secondary_color'])
						->config('horizon_text_color', $data['text_color'])
						->config('horizon_background_color', $data['background_color'])
						->config('horizon_content_width', $data['content_width']);

				notify($this->lang('Apparence du thème mise à jour'));
				refresh();
			})
			->submit($this->lang('Enregistrer'))
			->panel()
			->title($this->lang('Identité visuelle'), 'fas fa-palette');

		return $this->row($this->col($form)->size('col-12'));
	}
}
