<!-- resources\views\rdvs\liste.blade.php -->



<?php $__env->startSection('htmlheader_title'); ?>
<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Production'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
<li class="active"><a href="<?php echo e(route('staffs.index')); ?>"><i class="fa fa-dashboard"></i> Production</a></li>
<li class="active">Liste</li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>
<div class="row">
    <div class="col-md-3">
        <!-- TYPE RENDEZ-VOUS -->
        <div class="box box-solid <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Type de production</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo e($typerdv=='tout' ? 'active' : ''); ?>">
                        <a href="tout">
                            <i class="fa fa-cubes"></i> Tout
                            <span class="label label-danger pull-right"><?php echo e(count($rendezvoustout)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Défiscalisation' ? 'active' : ''); ?>">
                        <a href="defiscalisation">
                            <i class="fa fa-money"></i> Défiscalisation
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsdefiscalisation)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Nettoyage pro' ? 'active' : ''); ?>">
                        <a href="nettoyagepro">
                            <i class="fa fa-eraser"></i> Nettoyage pro
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsnettoyagepro)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Assurance pro' ? 'active' : ''); ?>">
                        <a href="assurancepro">
                            <i class="fa fa-ticket"></i> Assurance pro
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsassurancepro)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Mutuelle santé sénior' ? 'active' : ''); ?>">
                        <a href="mutuellesantesenior">
                            <i class="fa fa-universal-access"></i> Mutuelle santé sénior
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsmutuellesantesenior)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Autres' ? 'active' : ''); ?>">
                        <a href="autre">
                            <i class="fa fa-adjust"></i> Autres
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsautre)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Réception d\’appels' ? 'active' : ''); ?>">
                        <a href="appels">
                            <i class="fa fa-phone"></i> Réception d’appels
                            <span class="label label-danger pull-right"><?php echo e(count($appels)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Demande de devis' ? 'active' : ''); ?>">
                        <a href="devis">
                            <i class="fa fa-list"></i> Demande de devis
                            <span class="label label-danger pull-right"><?php echo e(count($devis)); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- STATUT RENDEZ-VOUS -->
        <div class="box box-solid">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Statut de production</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo e($typerdv=='tout' ? 'active' : ''); ?>">
                        <a href="tout">
                            <i class="fa fa-cubes"></i> Tout
                            <span class="label label-danger pull-right">
							<?php echo e(count($rendezvoustout)); ?>

							<!-- <?php if(Auth::user()->statut == 'Superviseur'): ?>
								xx <?php echo e($rendezvoustout->countBy('user_statut')->count()); ?> yy
							<?php endif; ?> -->
							</span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous brut' ? 'active' : ''); ?> <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                        <a href="brut">
                            <i class="fa fa-cube"></i> Rendez-vous brut
                            <span class="label label-danger pull-right">
							<?php echo e(count($rdvsbrut)); ?>

							<!-- <?php if(Auth::user()->statut == 'Superviseur'): ?>
								xx <?php echo e($rdvsbrut->countBy('user_statut')->count()); ?> yy
							<?php endif; ?> -->
							</span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous relancer' ? 'active' : ''); ?> <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                        <a href="relance">
                            <i class="fa fa-thumbs-o-up"></i> Rendez-vous refusé / relancer
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsrelancer)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous refusé' ? 'active' : ''); ?> <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                        <a href="refuse">
                            <i class="fa fa-thumbs-o-down"></i> Rendez-vous refusé  / ne pas relancer
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsrefuse)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous envoyé' ? 'active' : ''); ?>">
                        <a href="envoye">
                            <i class="fa fa-send"></i> Rendez-vous envoyé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsenvoye)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous confirmé' ? 'active' : ''); ?>">
                        <a href="confirme">
                            <i class="fa fa-check-square-o"></i> Rendez-vous confirmé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsconfirme)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous annulé' ? 'active' : ''); ?>">
                        <a href="annule">
                            <i class="fa fa-arrow-left"></i> Rendez-vous annulé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsannule)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous en attente' ? 'active' : ''); ?>">
                        <a href="enattente">
                            <i class="fa  fa-spinner"></i> Rendez-vous en attente
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsenattente)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?>">
                        <a href="valide">
                            <i class="fa fa-thumbs-up"></i> Rendez-vous validé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsvalide)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?> <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                        <a href="appelsbrut">
                            <i class="fa fa-phone-square"></i> Réception d’appels brut
                            <span class="label label-danger pull-right"><?php echo e(count($appelsbrut)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?>">
                        <a href="appelsenvoye">
                            <i class="fa fa-phone"></i> Réception d’appels envoyé
                            <span class="label label-danger pull-right"><?php echo e(count($appelsenvoye)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?> <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                        <a href="devisbrut">
                            <i class="fa fa-list-alt"></i> Demande de devis brut
                            <span class="label label-danger pull-right"><?php echo e(count($devisbrut)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?>">
                        <a href="devisenvoye">
                            <i class="fa  fa-list"></i> Demande de devis envoyé
                            <span class="label label-danger pull-right"><?php echo e(count($devisenvoye)); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="col-md-9">
        <div class="box box-white">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Production </h3>

                <!-- <div class="box-tools  <?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?> pull-right rechercherdv <?php endif; ?> ">
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Recherche">
                        <span class="glyphicon glyphicon-search form-control-feedback rouge"></span>
                    </div>
                </div> -->
                <div class="box-tools pull-right ajoutrdv <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                    <form action="<?php echo e(route('rdvs.choisirclient')); ?>" method="post" class="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('GET'); ?>
                        <button class="btn btn-primary btn-sm" type="submit">Ajouter rendez-vous</button>
                    </form>
                </div>
					<button id="btnrdvexcel1" name="btnrdvexcel1" type="submit" class="pull-right box-tools exportexcelrdv btn btn-success btn-sm exportToExcel exportExcel">Export excel</button>
					<button id="btnrdvexcel0" name="btnrdvexcel0" type="submit" class="pull-right box-tools  btn btn-success btn-sm exportToExcel exportExcel">Export total</button>
				<!--                 
				<div class="box-tools pull-right hidden">
                    <form action="<?php echo e(route('rdvs.exportexcel')); ?>" class=""> 
                        <?php echo csrf_field(); ?>
                        
						<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-download"></i> Export total</button>
                    </form>
                </div> 
				-->
            </div>
            <div class="box-body no-padding">
                <!-- <div  class="table-responsive mailbox-messages"> -->
                <div  class="table-responsive box-body no-padding">	
					
					<table id="tablerdv" class="table table-hover table-striped table2excel">
						<thead class="theadexcel">
							<?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?>
                            <tr class="header">
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search "></th>
                                <th class="filter"><b>Référence</b></th>
								<th class="filter"><b>Campagne en cours</b></th>
                                <th class="filter exprtout hidden"><b>Nom</b></th>
                                <th class="filter exprtout hidden"><b>Prénom</b></th>
                                <th class="filter"><b>Société</b></th>
								<th class="filter exprtout hidden"><b>Adresse</b></th>
								<th class="filter exprtout hidden"><b>Code postal</b></th>
                                <th class="filter"><b>Ville</b></th>
                                <th class="filter"><b>Téléphone</b></th>
								<th class="filter exprtout hidden"><b>Mobile</b></th>
								<th class="filter exprtout hidden"><b>Email</b></th>
								<th class="filter exprtout hidden"><b>Activité société</b></th>
								<th class="filter exprtout hidden"><b>Question 1</b></th>
								<th class="filter exprtout hidden"><b>Question 2</b></th>
								<th class="filter exprtout hidden"><b>Question 3</b></th>
								<th class="filter exprtout hidden"><b>Question 4</b></th>
								<th class="filter exprtout hidden"><b>Question 5</b></th>
								<th class="filter exprtout hidden"><b>Surface total société</b></th>
								<th class="filter exprtout hidden"><b>Surface de bureau</b></th>
								<th class="filter exprtout hidden"><b>Sous contrat</b></th>
								<th class="filter exprtout hidden"><b>Date anniversaire du contrat</b></th>
								<th class="filter exprtout hidden"><b>Protection sociale</b></th>
								<th class="filter exprtout hidden"><b>Mutuelle santé</b></th>
								<th class="filter exprtout hidden"><b>Mutuelle entreprise</b></th>
								<th class="filter exprtout hidden"><b>Nom de sa mutuelle</b></th>
								<th class="filter exprtout hidden"><b>Montant de la mutuelle actuelle</b></th>
								<th class="filter exprtout hidden"><b>Seul sur le contrat</b></th>
								<th class="filter exprtout hidden"><b>Montant impot annuel</b></th>
								<th class="filter exprtout hidden"><b>Taux endettement</b></th>
								<th class="filter exprtout hidden"><b>Age</b></th>
								<th class="filter exprtout hidden"><b>Profession</b></th>
								<th class="filter exprtout hidden"><b>Propriétaire ou Locataire</b></th>
								<th class="filter exprtout hidden"><b>Statut matrimonial</b></th>
								<th class="filter exprtout hidden"><b>Composition foyer</b></th>
								<th class="filter exprtout hidden"><b>Nom et prénom du contact</b></th>
                                <th class="filter"><b>Nom de la personne au rendez-vous</b></th>
                                <th class="filter"><b>Qualification</b></th>
								<th class="filter date"><b>Date rendez-vous</b></th>
                                <th class="filter"><b>Heure rendez-vous</b></th>
                                <th class="filter"><b>Date de création</b></th>
                                <th class="filter"><b>Dernière modification  </b></th>
                            </tr>
							<?php elseif(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
                            <tr class="header">
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>"></th>
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>"></th>
                                <th class="filter"><b>Référence</b></th>
								<th class="filter"><b>Centre d’appels</b></th>
                                <th class="filter"><b>Responsable/agent</b></th>
								<th class="filter"><b>Campagne en cours</b></th>
                                <th class="filter exprtout hidden"><b>Nom</b></th>
                                <th class="filter exprtout hidden"><b>Prénom</b></th>
                                <th class="filter"><b>Société</b></th>
								<th class="filter exprtout hidden"><b>Adresse</b></th>
								<th class="filter exprtout hidden"><b>Code postal</b></th>
                                <th class="filter"><b>Ville</b></th>
                                <th class="filter"><b>Téléphone</b></th>
								<th class="filter exprtout hidden"><b>Mobile</b></th>
								<th class="filter exprtout hidden"><b>Email</b></th>
								<th class="filter exprtout hidden"><b>Activité société</b></th>
								<th class="filter exprtout hidden"><b>Question 1</b></th>
								<th class="filter exprtout hidden"><b>Question 2</b></th>
								<th class="filter exprtout hidden"><b>Question 3</b></th>
								<th class="filter exprtout hidden"><b>Question 4</b></th>
								<th class="filter exprtout hidden"><b>Question 5</b></th>
								<th class="filter exprtout hidden"><b>Surface total société</b></th>
								<th class="filter exprtout hidden"><b>Surface de bureau</b></th>
								<th class="filter exprtout hidden"><b>Sous contrat</b></th>
								<th class="filter exprtout hidden"><b>Date anniversaire du contrat</b></th>
								<th class="filter exprtout hidden"><b>Protection sociale</b></th>
								<th class="filter exprtout hidden"><b>Mutuelle santé</b></th>
								<th class="filter exprtout hidden"><b>Mutuelle entreprise</b></th>
								<th class="filter exprtout hidden"><b>Nom de sa mutuelle</b></th>
								<th class="filter exprtout hidden"><b>Montant de la mutuelle actuelle</b></th>
								<th class="filter exprtout hidden"><b>Seul sur le contrat</b></th>
								<th class="filter exprtout hidden"><b>Montant impot annuel</b></th>
								<th class="filter exprtout hidden"><b>Taux endettement</b></th>
								<th class="filter exprtout hidden"><b>Age</b></th>
								<th class="filter exprtout hidden"><b>Profession</b></th>
								<th class="filter exprtout hidden"><b>Propriétaire ou Locataire</b></th>
								<th class="filter exprtout hidden"><b>Statut matrimonial</b></th>
								<th class="filter exprtout hidden"><b>Composition foyer</b></th>
								<th class="filter exprtout hidden"><b>Nom et prénom du contact</b></th>
                                <th class="filter"><b>Nom de la personne au rendez-vous</b></th>
                                <th class="filter"><b>Qualification</b></th>
								<th class="filter date"><b>Date rendez-vous</b></th>
                                <!-- <th class="filter">kDate rendez-vous</th> -->
                                <th class="filter"><b>Heure rendez-vous</b></th>
                                <th class="filter"><b>Rendez-vous pour</b></th>
								<th class="filter exprtout hidden"><b>Note</b></th>
								<th class="filter exprtout hidden"><b>Note du Staff</b></th>
                                <th class="filter"><b>Date de création</b></th>
                                <th class="filter"><b>Dernière modification </b></th>
                            </tr>
							
							<?php elseif(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
                            <tr class="header">
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search ">Bouton détail</th>
                                <th class="filter"><b>Référence</b></th>
								<th class=""><b>Type</b></th>
                                <th class="filter exprtout hidden"><b>Nom</b></th>
                                <th class="filter exprtout hidden"><b>Prénom</b></th>
                                <th class=""><b>Société</b></th>
								<th class="filter exprtout hidden"><b>Adresse</b></th>
								<th class="filter exprtout hidden"><b>Code postal</b></th>
                                <th class=""><b>Ville</b></th>
                                <th class=""><b>Téléphone</b></th>
								<th class="filter exprtout hidden"><b>Mobile</b></th>
								<th class="filter exprtout hidden"><b>Email</b></th>
								<th class="filter exprtout hidden"><b>Activité société</b></th>
								<th class="filter exprtout hidden"><b>Question 1</b></th>
								<th class="filter exprtout hidden"><b>Question 2</b></th>
								<th class="filter exprtout hidden"><b>Question 3</b></th>
								<th class="filter exprtout hidden"><b>Question 4</b></th>
								<th class="filter exprtout hidden"><b>Question 5</b></th>
								<th class="filter exprtout hidden"><b>Surface total société</b></th>
								<th class="filter exprtout hidden"><b>Surface de bureau</b></th>
								<th class="filter exprtout hidden"><b>Sous contrat</b></th>
								<th class="filter exprtout hidden"><b>Date anniversaire du contrat</b></th>
								<th class="filter exprtout hidden"><b>Protection sociale</b></th>
								<th class="filter exprtout hidden"><b>Mutuelle santé</b></th>
								<th class="filter exprtout hidden"><b>Mutuelle entreprise</b></th>
								<th class="filter exprtout hidden"><b>Nom de sa mutuelle</b></th>
								<th class="filter exprtout hidden"><b>Montant de la mutuelle actuelle</b></th>
								<th class="filter exprtout hidden"><b>Seul sur le contrat</b></th>
								<th class="filter exprtout hidden"><b>Montant impot annuel</b></th>
								<th class="filter exprtout hidden"><b>Taux endettement</b></th>
								<th class="filter exprtout hidden"><b>Age</b></th>
								<th class="filter exprtout hidden"><b>Profession</b></th>
								<th class="filter exprtout hidden"><b>Propriétaire ou Locataire</b></th>
								<th class="filter exprtout hidden"><b>Statut matrimonial</b></th>
								<th class="filter exprtout hidden"><b>Composition foyer</b></th>
								<th class="filter exprtout hidden"><b>Nom et prénom du contact</b></th>
                                <th class=""><b>Nom de la personne rendez-vous</b></th>
                                <th class="filter"><b>Qualification</b></th>
								<th class="filter date"><b>Date rendez-vous</b></th>
                                <th class=""><b>Heure rendez-vous</b></th>
                                <th class="filter"><b>Rendez-vous pour</b></th>
								<th class="filter exprtout hidden"><b>Note</b></th>
                            </tr>
							<?php endif; ?>
						</thead>
                        <tbody>
						<!-- Rendezvous = <?php echo $rendezvous; ?> -->
						<!-- Auth::user() = <?php echo Auth::user(); ?> -->
                        <?php $__currentLoopData = $rendezvous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<!-- id_groupe: <?php echo e($rdv->id_groupe); ?> -->
							<?php if(Auth::user()->statut == 'Superviseur'): ?>
							<!-- <div><?php echo e(Auth::user()->centreappel_id); ?></div> -->
								<!-- <tr class="<?php if($rdv->user_statut <> 'Superviseur' && $rdv->user_statut <> 'Agent'): ?> hidden <?php endif; ?>"> -->
								<tr class="<?php if($rdv->id_groupe <> Auth::user()->centreappel_id): ?> hidden <?php endif; ?>"> 
									<td  class="noExl no-filter <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>">
										<form action="<?php echo e(route('rdvs.edit', [$rdv])); ?>" method="post" >
											<?php echo csrf_field(); ?>
											<?php echo method_field('GET'); ?>
											<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
										</form>
									</td>
									<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
									<?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?>
									<td class=""><?php echo e($rdv->cli); ?></td>
									<?php endif; ?>
									<td class="hidden exprtout"><?php echo e($rdv->nom); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->prenom); ?></td>
									<td class=""><?php echo e($rdv->societe); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->adresse); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->cp); ?></td>
									<td class=""><?php echo e($rdv->ville); ?></td>
									<td class=""><?php echo e($rdv->telephone); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mobile); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->email); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->activitesociete); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_1); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_2); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_3); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_4); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_5); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->surface_total_societe); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->surface_bureau); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->sous_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->date_anniversaire_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->protectionsociale); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mutuellesante); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mutuelle_entreprise); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->nom_mutuelle); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->montant_mutuelle_actuelle); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->seul_sur_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->montant_impots_annuel); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->taux_endettement); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->age); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->profession); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->proprietaireoulocataire); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->statut_matrimonial); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->composition_foyer); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->nomprenomcontact); ?></td>
									<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
									<td class=""><?php if($rdv->statut=='Rendez-vous relancer'): ?> Rendez-vous refusé / relancer <?php elseif($rdv->statut=='Rendez-vous refusé'): ?> Rendez-vous refusé / ne pas relancer <?php else: ?> <?php echo e($rdv->statut); ?> <?php endif; ?> </td>
									<td dateformat="DD MM YYYY" isType="date" class="filter"><?php echo e($rdv->date_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
                                    <td> <?php echo e($rdv->created_at->format('j-m-Y H:i')); ?></td>
                                    <td> <?php echo e($rdv->updated_at->format('j-m-Y H:i')); ?></td>
								</tr>
							<?php elseif(Auth::user()->statut == 'Agent'): ?>
								<tr class="<?php if($rdv->user_id <> Auth::user()->_id): ?> hidden <?php endif; ?>">
									<td class="noExl no-filter <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>">
										<form action="<?php echo e(route('rdvs.edit', [$rdv])); ?>" method="post" >
											<?php echo csrf_field(); ?>
											<?php echo method_field('GET'); ?>
											<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
										</form>
									</td>
									<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
									<?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?>
									<td class=""><?php echo e($rdv->cli); ?></td>
									<?php endif; ?>
									<td class="hidden exprtout"><?php echo e($rdv->nom); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->prenom); ?></td>
									<td class=""><?php echo e($rdv->societe); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->adresse); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->cp); ?></td>
									<td class=""><?php echo e($rdv->ville); ?></td>
									<td class=""><?php echo e($rdv->telephone); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mobile); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->email); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->activitesociete); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_1); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_2); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_3); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_4); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_5); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->surface_total_societe); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->surface_bureau); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->sous_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->date_anniversaire_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->protectionsociale); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mutuellesante); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mutuelle_entreprise); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->nom_mutuelle); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->montant_mutuelle_actuelle); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->seul_sur_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->montant_impots_annuel); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->taux_endettement); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->age); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->profession); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->proprietaireoulocataire); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->statut_matrimonial); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->composition_foyer); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->nomprenomcontact); ?></td>
									<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
									<td class=""><?php if($rdv->statut=='Rendez-vous relancer'): ?> Rendez-vous refusé / relancer <?php elseif($rdv->statut=='Rendez-vous refusé'): ?> Rendez-vous refusé / ne pas relancer <?php else: ?> <?php echo e($rdv->statut); ?> <?php endif; ?> </td>
									<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
                                    <td> <?php echo e($rdv->created_at->format('j-m-Y H:i')); ?></td>
                                    <td> <?php echo e($rdv->updated_at->format('j-m-Y H:i')); ?></td>
								</tr>
							<?php elseif(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
							<!-- <?php echo $rdv; ?> -->
							<tr class="<?php if($rdv->statut == 'Rendez-vous brut' || $rdv->statut == 'Rendez-vous refusé'): ?> hidden <?php endif; ?>">
                                <!-- <td class="">
                                    <form action="<?php echo e(route('rdvs.contester', [$rdv])); ?>" method="post" >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('GET'); ?>
                                        <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Contester</button>
                                    </form>
                                </td> -->
								<td class="noExl no-filter ">
									<form action="<?php echo e(route('rdvs.details', [$rdv])); ?>" method="post" >
										<?php echo csrf_field(); ?>
										<?php echo method_field('GET'); ?>
										<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Détails</button>
									</form>
								</td>
                                <td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
								<td class=""><?php echo e($rdv->typerdv); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->nom); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->prenom); ?></td>
								<td class=""><?php echo e($rdv->societe); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->adresse); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->cp); ?></td>
								<td class=""><?php echo e($rdv->ville); ?></td>
								<td class=""><?php echo e($rdv->telephone); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->mobile); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->email); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->activitesociete); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->question_1); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->question_2); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->question_3); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->question_4); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->question_5); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->surface_total_societe); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->surface_bureau); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->sous_contrat); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->date_anniversaire_contrat); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->protectionsociale); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->mutuellesante); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->mutuelle_entreprise); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->nom_mutuelle); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->montant_mutuelle_actuelle); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->seul_sur_contrat); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->montant_impots_annuel); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->taux_endettement); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->age); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->profession); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->proprietaireoulocataire); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->statut_matrimonial); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->composition_foyer); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->nomprenomcontact); ?></td>
								<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
								<td class=""><?php if($rdv->statut=='Rendez-vous relancer'): ?> Rendez-vous refusé / relancer <?php elseif($rdv->statut=='Rendez-vous refusé'): ?> Rendez-vous refusé / ne pas relancer <?php else: ?> <?php echo e($rdv->statut); ?> <?php endif; ?> </td>
								<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
								<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
								<td class=""><?php echo e($rdv->client_prenompriv); ?> <?php echo e($rdv->client_nompriv); ?></td>
								<td class="hidden exprtout"><?php echo e($rdv->note); ?></td>
                            </tr>
                            
							<?php elseif(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
								<tr>
									<td class="noExl no-filter <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>">
										<form action="<?php echo e(route('rdvs.edit', [$rdv])); ?>" method="post" >
											<?php echo csrf_field(); ?>
											<?php echo method_field('GET'); ?>
											<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
										</form>
									</td>
									<td class="noExl no-filter <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>">
										<!-- <form  action = "<?php echo e(route('rdvs.destroy', [$rdv])); ?>" method="post" class=""> -->
										<form action="<?php echo e(route('rdvs.destroy', $rdv->id)); ?>" method="post" class="" onsubmit="return confirmDelete();">
											<?php echo csrf_field(); ?>
											<?php echo method_field('DELETE'); ?>
											
											<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
										</form>
									</td>
									<!-- <td class=""></td> -->
									<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
									<td class=""><?php echo e($rdv->centreappel_societe); ?></td>
									<td class=""><?php echo e($rdv->user_prenom); ?> <?php echo e($rdv->user_nom); ?></td>
									<td class=""><?php echo e($rdv->cli); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->nom); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->prenom); ?></td>
									<td class=""><?php echo e($rdv->societe); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->adresse); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->cp); ?></td>
									<td class=""><?php echo e($rdv->ville); ?></td>
									<td class=""><?php echo e($rdv->telephone); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mobile); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->email); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->activitesociete); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_1); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_2); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_3); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_4); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->question_5); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->surface_total_societe); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->surface_bureau); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->sous_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->date_anniversaire_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->protectionsociale); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mutuellesante); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->mutuelle_entreprise); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->nom_mutuelle); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->montant_mutuelle_actuelle); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->seul_sur_contrat); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->montant_impots_annuel); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->taux_endettement); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->age); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->profession); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->proprietaireoulocataire); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->statut_matrimonial); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->composition_foyer); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->nomprenomcontact); ?></td>
									<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
									<td class=""><?php if($rdv->statut=='Rendez-vous relancer'): ?> Rendez-vous refusé / relancer <?php elseif($rdv->statut=='Rendez-vous refusé'): ?> Rendez-vous refusé / ne pas relancer <?php else: ?> <?php echo e($rdv->statut); ?> <?php endif; ?></td>
									<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->client_prenompriv); ?> <?php echo e($rdv->client_nompriv); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->note); ?></td>
									<td class="hidden exprtout"><?php echo e($rdv->notestaff); ?></td>

                                    <td> <?php echo e($rdv->created_at->format('j-m-Y H:i')); ?></td>
                                    <td> <?php echo e($rdv->updated_at->format('j-m-Y H:i')); ?></td>
								</tr>
							<?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </tbody>
                    
					</table>
					<button id="btnrdvexcel" class="btn btn-success btn-sm exportToExcel hidden ">Export excel</button>
                </div>
            </div>
        
		</div>


	
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\crm1\resources\views/rdvs/liste.blade.php ENDPATH**/ ?>