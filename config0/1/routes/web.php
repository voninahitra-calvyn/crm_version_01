<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/connexion');
    // return view('home');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('centreappels', 'CentreappelController');
	Route::name('centreappels.')->group(function () {
		Route::get('centreappels/{id}/compte','CentreappelController@compte')->name('compte');
		Route::get('centreappels/{id}/modifcompte','CentreappelController@modifcompte')->name('modifcompte');
		Route::get('centreappels/{id}/createcompte','CentreappelController@createcompte')->name('createcompte');
		Route::get('centreappels/{id}/storecompte','CentreappelController@storecompte')->name('storecompte');
		Route::get('centreappels/{id}/updatecompte','CentreappelController@updatecompte')->name('updatecompte');
		Route::get('centreappels/{id}/suppcompte','CentreappelController@suppcompte')->name('suppcompte');
	});
	Route::resource('clients', 'ClientController');
	Route::name('clients.')->group(function () {
		Route::get('clients/{id}/compte','ClientController@compte')->name('compte');
		Route::get('clients/{id}/modifcompte','ClientController@modifcompte')->name('modifcompte');
		Route::get('clients/{id}/createcompte','ClientController@createcompte')->name('createcompte');
		Route::get('clients/{id}/storecompte','ClientController@storecompte')->name('storecompte');
		Route::get('clients/{id}/updatecompte','ClientController@updatecompte')->name('updatecompte');
		Route::get('clients/{id}/suppcompte','ClientController@suppcompte')->name('suppcompte');
		Route::get('rendez-vous/{id}/ajout','ClientController@rendezvous')->name('rendezvous');
	});
	Route::resource('administrateurs', 'AdministrateurController');
	Route::name('administrateurs.')->group(function () {
		Route::get('administrateurs/{id}/compte','AdministrateurController@compte')->name('compte');
		Route::get('administrateurs/{id}/modifcompte','AdministrateurController@modifcompte')->name('modifcompte');
		Route::get('administrateurs/{id}/createcompte','AdministrateurController@createcompte')->name('createcompte');
		Route::get('administrateurs/{id}/storecompte','AdministrateurController@storecompte')->name('storecompte');
		Route::get('administrateurs/{id}/updatecompte','AdministrateurController@updatecompte')->name('updatecompte');
		Route::get('administrateurs/{id}/suppcompte','AdministrateurController@suppcompte')->name('suppcompte');
	});
	Route::resource('staffs', 'StaffController');
	Route::name('staffs.')->group(function () {
		Route::get('staffs/{id}/modifmotdepasse','StaffController@modifmotdepasse')->name('modifmotdepasse');
		Route::get('staffs/{id}/modifinfo','StaffController@modifinfo')->name('modifinfo');
	});

	Route::get('events', 'EventController@index');
	Route::resource('rdvs', 'RdvController');
	Route::name('rdvs.')->group(function () {
		Route::get('rendez-vous/{id}/client','RdvController@client')->name('client');
		Route::get('rendez-vous/contester/{id}','RdvController@contester')->name('contester');
		Route::get('rendez-vous/details/{id}','RdvController@details')->name('details');
		Route::get('rendez-vous/contestation/{id}','RdvController@contestation')->name('contestation');
		Route::get('rendez-vous/tout','RdvController@tout')->name('tout');
		Route::get('rendez-vous/brut','RdvController@brut')->name('brut');
		Route::get('rendez-vous/relance','RdvController@relance')->name('relance');
		Route::get('rendez-vous/refuse','RdvController@refuse')->name('refuse');
		Route::get('rendez-vous/envoye','RdvController@envoye')->name('envoye');
		Route::get('rendez-vous/confirme','RdvController@confirme')->name('confirme');
		Route::get('rendez-vous/annule','RdvController@annule')->name('annule');
		Route::get('rendez-vous/enattente','RdvController@enattente')->name('enattente');
		Route::get('rendez-vous/valide','RdvController@valide')->name('valide');
		Route::get('rendez-vous/appelsbrut','RdvController@appelsbrut')->name('appelsbrut');
		Route::get('rendez-vous/appelsenvoye','RdvController@appelsenvoye')->name('appelsenvoye');
		Route::get('rendez-vous/devisbrut','RdvController@devisbrut')->name('devisbrut');
		Route::get('rendez-vous/devisenvoye','RdvController@devisenvoye')->name('devisenvoye');
		Route::get('rendez-vous/defiscalisation','RdvController@defiscalisation')->name('defiscalisation');
		Route::get('rendez-vous/defiscalisation/create','RdvController@createrdvdefiscalisation')->name('createrdvdefiscalisation');
		Route::get('rendez-vous/defiscalisation/storerdv','RdvController@storerdv')->name('storerdv');
		Route::get('rendez-vous/defiscalisation/{id}/modifrdv','RdvController@modifrdv')->name('modifrdv');
		Route::get('rendez-vous/defiscalisation/{id}/updaterdv','RdvController@updaterdv')->name('updaterdv');
		Route::get('rendez-vous/defiscalisation/{id}/supprdv','RdvController@supprdv')->name('supprdv');
		Route::get('rendez-vous/mail','RdvController@mail')->name('mail');
		
		Route::get('rendez-vous/nettoyagepro','RdvController@nettoyagepro')->name('nettoyagepro');
		Route::get('rendez-vous/assurancepro','RdvController@assurancepro')->name('assurancepro');
		Route::get('rendez-vous/mutuellesantesenior','RdvController@mutuellesantesenior')->name('mutuellesantesenior');
		Route::get('rendez-vous/autre','RdvController@autre')->name('autre');
		Route::get('rendez-vous/appels','RdvController@appels')->name('appels');
		Route::get('rendez-vous/devis','RdvController@devis')->name('devis');
		Route::get('rendez-vous/choisirclient','RdvController@choisirclient')->name('choisirclient');
		Route::get('rendez-vous/exportexcel','RdvController@exportexcel')->name('exportexcel');
		Route::get('rendez-vous/exportpdf/{id}','RdvController@exportpdf')->name('exportpdf');
		Route::get('rdvs/{id}/edit','RdvController@modifaudio')->name('modifaudio');
		Route::get('rendez-vous/requete','RdvController@requete')->name('requete');
	});
	Route::resource('agendas', 'AgendaController');
	Route::name('agendas.')->group(function () {
		// Route::get('agendas/{id}','AgendaController@update')->name('update');
		// Route::get('agendas','AgendaController@suppEvent')->name('suppEvent');
		Route::get('agendas/{id}/suppEvent','AgendaController@suppEvent')->name('suppEvent');
		Route::get('agendas','AgendaController@index')->name('index');
		// Route::get('{id}','AgendaController@agenda2')->name('agenda2');
	});
	
	
	Route::resource('home', 'HomeController');
	/* Route::name('home.')->group(function () {
		// Route::get('home/{id}/edit','HomeController@edit')->name('edit');
		Route::get('home/{id}','HomeController@modifhome')->name('modifhome');
		Route::get('home/{id}/validermodifhome','HomeController@validermodifhome')->name('validermodifhome');
	}); */

	Route::resource('supports', 'SupportController');
	Route::name('supports.')->group(function () {
		Route::get('supports/{id}/repondreticket','SupportController@repondreticket')->name('repondreticket');
	});
});

Route::name('agendas.')->group(function () {
	Route::get('admnstaff/{id}','AgendaController@agenda2')->name('agenda2');
	Route::get('comresp/{id}','AgendaController@agenda3')->name('agenda3');
	Route::get('comresp_public/{id}','AgendaController@comresp_public')->name('comresp_public');
});

