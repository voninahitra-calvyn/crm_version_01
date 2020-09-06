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
                    <li class="<?php echo e($statutrdv=='Rendez-vous refusé' ? 'active' : ''); ?> <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                        <a href="refuse">
                            <i class="fa fa-thumbs-o-down"></i> Rendez-vous refusé
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
                            <i class="fa fa-thumbs-o-up"></i> Rendez-vous validé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsvalide)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?>">
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
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?>">
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
                <div class="box-tools pull-right rechercherdv <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                    <form action="<?php echo e(route('rdvs.choisirclient')); ?>" method="post" class="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('GET'); ?>
                        <button class="btn btn-primary btn-sm" type="submit">Ajouter rendez-vous</button>
                    </form>
                </div>&nbsp;&nbsp;
                <div class="box-tools pull-right ">
                    <form action="<?php echo e(route('rdvs.exportexcel')); ?>" class="">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-download"></i> Export Excel</button>
                    </form>
                </div>
            </div>
            <div class="box-body no-padding">
                <!-- <div  class="table-responsive mailbox-messages"> -->
                <div  class="table-responsive box-body no-padding">
<!-- 
<table id="table" class="table table-bordered table-intel">
    <thead>
        <tr>
            <th class="filter">Animal</th>
            <th class="filter">Class</th>
            <th class="filter">Collective Noun</th>
            <th dateformat="DD MM YYYY" isType="date" class="filter">Date</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Bear</td>
            <td>Mammal</td>
            <td>Sleuth</td>
            <td>11 04 2018</td>
        </tr>
        <tr>
            <td>Ant</td>
            <td>Insect</td>
            <td>Army</td>
            <td>11 05 2018</td>
        </tr>
        <tr>
            <td>Salamander</td>
            <td>Amphibian</td>
            <td>Congress</td>
            <td>11 04 2018</td>
        </tr>
        <tr>
            <td>Owl</td>
            <td>Bird</td>
            <td>Parliament</td>
            <td>10 04 2018</td>
        </tr>
        <tr>
            <td>Frog</td>
            <td>Amphibian</td>
            <td>Army</td>
            <td>1 04 2018</td>
        </tr>
        <tr>
            <td>Shark</td>
            <td>Fish</td>
            <td>Gam</td>
            <td>11 04 2018</td>
        </tr>
        <tr>
            <td>Kookaburra</td>
            <td>Bird</td>
            <td>Cackle</td>
            <td>21 04 2018</td>
        </tr>
        <tr>
            <td>Crow</td>
            <td>Bird</td>
            <td>Murder</td>
            <td>23 04 2018</td>
        </tr>
        <tr>
            <td>Elephant</td>
            <td>Mammal</td>
            <td>Herd</td>
            <td>11 03 2018</td>
        </tr>
        <tr>
            <td>Barracude</td>
            <td>Fish</td>
            <td>Grist</td>
            <td>30 04 2018</td>
        </tr>
    </tbody>
</table>
 -->                    
					<table id="tablerdv" class="table table-hover table-striped">
						<thead class="theadexcel">
							<?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?>
                            <tr class="header">
                                <th style="width: 50px;" class=""></th>
                                <th>Référence</th>
								<th class="filter">Campagne en cours</th>
                                <th class="filter">Société</th>
                                <th class="filter">Ville</th>
                                <th class="filter">Téléphone</th>
                                <th class="filter">Nom de la personne au rendez-vous</th>
                                <th class="filter">Qualification</th>
								<th class="filter date">Date rendez-vous</th>
                                <th class="filter">Heure rendez-vous</th>
                            </tr>
							<?php elseif(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
                            <tr class="header">
                                <th style="width: 50px;" class="no-filter no-sort no-search <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>"></th>
                                <th style="width: 50px;" class="no-filter no-sort no-search <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>"></th>
                                <th class="filter">Référence</th>
								<th class="filter">Centre d’appels</th>
                                <th class="filter">Responsable/agent</th>
								<th class="filter">Campagne en cours</th>
                                <th class="filter">Société</th>
                                <th class="filter">Ville</th>
                                <th class="filter">Téléphone</th>
                                <th class="filter">Nom de la personne au rendez-vous</th>
                                <th class="filter">Qualification
								</th>
								<th class="filter date">Date rendez-vous</th>
                                <!-- <th class="filter">kDate rendez-vous</th> -->
                                <th class="filter">Heure rendez-vous</th>
                                <th class="filter">Rendez-vous pour</th>
                            </tr>
							
							<?php elseif(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
                            <tr class="header">
                                <th style="width: 50px;">Bouton détail</th>
                                <th class="filter">Référence</th>
								<th class="">Type</th>
                                <th class="">Société</th>
                                <th class="">Ville</th>
                                <th class="">Téléphone</th>
                                <th class="">Nom de la personne rendez-vous</th>
                                <th class="filter">Qualification</th>
								<th class="filter date">Date rendez-vous</th>
                                <th class="">Heure rendez-vous</th>
                                <th class="filter">Rendez-vous pour</th>
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
									<td class="<?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>">
										<form action="<?php echo e(route('rdvs.edit', [$rdv])); ?>" method="post" >
											<?php echo csrf_field(); ?>
											<?php echo method_field('GET'); ?>
											<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
										</form>
									</td>
									<td class="<?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>">
										<form action="<?php echo e(route('rdvs.destroy', $rdv->id)); ?>" method="post" class="">
											<?php echo csrf_field(); ?>
											<?php echo method_field('DELETE'); ?>
											
											<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
										</form>
									</td>
									<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
									<?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?>
									<td class=""><?php echo e($rdv->cli); ?></td>
									<?php endif; ?>
									<td class=""><?php echo e($rdv->societe); ?></td>
									<td class=""><?php echo e($rdv->ville); ?></td>
									<td class=""><?php echo e($rdv->telephone); ?></td>
									<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->statut); ?></td>
									<td dateformat="DD MM YYYY" isType="date" class="filter"><?php echo e($rdv->date_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
								</tr>
							<?php elseif(Auth::user()->statut == 'Agent'): ?>
								<tr class="<?php if($rdv->user_id <> Auth::user()->_id): ?> hidden <?php endif; ?>">
									<td class="<?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>">
										<form action="<?php echo e(route('rdvs.edit', [$rdv])); ?>" method="post" >
											<?php echo csrf_field(); ?>
											<?php echo method_field('GET'); ?>
											<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
										</form>
									</td>
									<td class="<?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>">
										<form action="<?php echo e(route('rdvs.destroy', $rdv->id)); ?>" method="post" class="">
											<?php echo csrf_field(); ?>
											<?php echo method_field('DELETE'); ?>
											
											<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
										</form>
									</td>
									<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
									<?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?>
									<td class=""><?php echo e($rdv->cli); ?></td>
									<?php endif; ?>
									<td class=""><?php echo e($rdv->societe); ?></td>
									<td class=""><?php echo e($rdv->ville); ?></td>
									<td class=""><?php echo e($rdv->telephone); ?></td>
									<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->statut); ?></td>
									<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
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
								<td class="">
									<form action="<?php echo e(route('rdvs.details', [$rdv])); ?>" method="post" >
										<?php echo csrf_field(); ?>
										<?php echo method_field('GET'); ?>
										<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Détails</button>
									</form>
								</td>
                                <td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
								<td class=""><?php echo e($rdv->typerdv); ?></td>
								<td class=""><?php echo e($rdv->societe); ?></td>
								<td class=""><?php echo e($rdv->ville); ?></td>
								<td class=""><?php echo e($rdv->telephone); ?></td>
								<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
								<td class=""><?php echo e($rdv->statut); ?></td>
								<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
								<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
								<td class=""><?php echo e($rdv->client_prenompriv); ?> <?php echo e($rdv->client_nompriv); ?></td>
                            </tr>
                            
							<?php elseif(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
								<tr>
									<td class="<?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>">
										<form action="<?php echo e(route('rdvs.edit', [$rdv])); ?>" method="post" >
											<?php echo csrf_field(); ?>
											<?php echo method_field('GET'); ?>
											<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
										</form>
									</td>
									<td class="<?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>">
										<!-- <form  action = "<?php echo e(route('rdvs.destroy', [$rdv])); ?>" method="post" class=""> -->
										<form action="<?php echo e(route('rdvs.destroy', $rdv->id)); ?>" method="post" class="">
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
									<td class=""><?php echo e($rdv->societe); ?></td>
									<td class=""><?php echo e($rdv->ville); ?></td>
									<td class=""><?php echo e($rdv->telephone); ?></td>
									<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->statut); ?></td>
									<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->client_prenompriv); ?> <?php echo e($rdv->client_nompriv); ?></td>

								</tr>
							<?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </tbody>
                    
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/rdvs/liste.blade.php ENDPATH**/ ?>