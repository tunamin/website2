<?php
namespace App\Controllers;

/**
 * controllers/download.php
 *
 * Tell them how to get the framework
 * 
 * CodeIgniter website, template driven
 */
class Download extends BaseController
{

	//-------------------------------------------------------------
	//  The normal pages
	//-------------------------------------------------------------

	function index()
	{
		$this->data['title'] = lang('Download.title');
		$this->data['pagebody'] = 'download';

		$gitter = new \App\Libraries\GithubAPI();

		$info4 = $gitter->getLatestRelease('codeigniter4', 'framework');
		$this->data['v4name'] = $info4['tag_name'];
		$this->data['v4link'] = $info4['zipball_url'];

		$info3 = $gitter->getLatestTag('bcit-ci', 'codeigniter');
		$this->data['v3name'] = $info3['name'];
		$this->data['v3link'] = $info3['zipball_url'];

		// localized page pieces
		$this->localize('Download', 'heading');
		$this->localize('Download', 'downloadButton');
		$this->localize('Download', 'discussButton');
		$this->localize('Download', 'sourcesButton');
		$this->localize('Download', 'translationsButton');

		// CI4 block, with nested substitution
		$this->localize('Download', 'ci4Title');
		$original = $this->parsedown->text(lang('Download.ci4Text'));
		$this->data['ci4Text'] = $this->parser->setData($this->data, 'raw')
				->renderString($original);

		// CI3 block, with nested substitution
		$this->localize('Download', 'ci3Title');
		$original = $this->parsedown->text(lang('Download.ci3Text'));
		$this->data['ci3Text'] = $this->parser->setData($this->data, 'raw')
				->renderString($original);

		// CI2 block, with nested substitution
		$this->localize('Download', 'ci2Title');
		$original = $this->parsedown->text(lang('Download.ci2Text'));
		$this->data['ci2Text'] = $this->parser->setData($this->data, 'raw')
				->renderString($original);

		$this->render();
	}

}
