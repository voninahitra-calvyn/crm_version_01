<?php $__env->startSection('htmlheader_title'); ?>
<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Rendez-vous'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
<li class="active"><a href="<?php echo e(route('staffs.index')); ?>"><i class="fa fa-dashboard"></i> Rendez-vous</a></li>
<li class="active">Liste</li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>
<div class="row">
    <div class="col-md-3">
        <!-- TYPE RENDEZ-VOUS -->
        <div class="box box-solid">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Type rendez-vous</h3>
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
                </ul>
            </div>
        </div>

        <!-- STATUT RENDEZ-VOUS -->
        <div class="box box-solid">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Statut rendez-vous</h3>
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
                </ul>
            </div>
        </div>

    </div>

    <div class="col-md-9">
        <div class="box box-white">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Rendez-vous </h3>

                <!-- <div class="box-tools  <?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?> pull-right rechercherdv <?php endif; ?> ">
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Recherche">
                        <span class="glyphicon glyphicon-search form-control-feedback rouge"></span>
                    </div>
                </div> -->
                <div class="box-tools pull-right <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
                    <form action="<?php echo e(route('rdvs.choisirclient')); ?>" method="post" class="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('GET'); ?>
                        <button class="btn btn-success btn-sm" type="submit">Ajouter rendez-vous</button>
                    </form>
                </div>
            </div>
            <div class="box-body no-padding">
                <!-- <div  class="table-responsive mailbox-messages"> -->
                <div  class="table-responsive box-body no-padding">
                    <table id="tablerdv" class="table table-hover table-striped">
						<thead class="theadexcel">
							<?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?>
                            <tr class="header">
                                <th style="width: 50px;" class="<?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>"></th>
                                <th style="width: 50px;" class="<?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>"></th>
                                <?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?>
								<th class="sorting">Campagne en cours</th>
								<?php endif; ?>
                                <th class="sorting_desc">Société</th>
                                <!-- <th class="sorting_asc">Prénom</th>
                                <th class="">Adresse</th>
                                <th class="filter">CP</th> -->
                                <th class="filter">Ville</th>
                                <th class="filter">Téléphone</th>
                                <!-- <th class="filter">Mobile</th>
                                <th class="filter">Email</th>
                                <th class="filter">Age</th>
                                <th class="filter">Montant impot annuel</th>
                                <th class="filter">Taux endettement</th>
                                <th class="filter">Statut matrimonial</th>
                                <th class="filter">Composition foyer</th> -->
                                <th class="filter">Nom de la personne au rendez-vous</th>
                                <th class="filter">Qualification</th>
                                <th class="filter">Date rendez-vous</th>
                                <th class="filter">Heure rendez-vous</th>
                                <!-- <th class="filter">Note</th> -->
                            </tr>
							<?php endif; ?>
							<?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
                            <tr class="header">
                                <th style="width: 50px;">Bouton détail</th>
                                <!-- <th style="width: 50px;"></th> -->
                                <th class="">Type</th>
                                <th class="">Société</th>
                                <!-- <th class="">Adresse</th> -->
                                <!-- <th class="">CP</th> -->
                                <th class="">Ville</th>
                                <th class="">Téléphone</th>
                                <!-- <th class="">Mobile</th> -->
                                <!-- <th class="">Email</th> -->
                                <!-- <th class="">age</th> -->
                                <th class="">Nom de la personne rendez-vous</th>
                                <th class="filter">Qualification</th>
                                <th class="">Date rendez-vous</th>
                                <th class="">Heure rendez-vous</th>
                                <!-- <th class="">Note</th> -->
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
                                <td class=""><?php echo e($rdv->typerdv); ?></td>
								<td class=""><?php echo e($rdv->societe); ?></td>
								<td class=""><?php echo e($rdv->ville); ?></td>
								<td class=""><?php echo e($rdv->telephone); ?></td>
								<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
								<td class=""><?php echo e($rdv->statut); ?></td>
								<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
								<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
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
									<?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?>
									<td class=""><?php echo e($rdv->cli); ?></td>
									<?php endif; ?>
									<!-- <td class=""></td> -->
									<td class=""><?php echo e($rdv->societe); ?></td>
									<!-- <td class=""><?php echo e($rdv->prenom); ?></td>
									<td class=""><?php echo e($rdv->adresse); ?></td>
									<td class=""><?php echo e($rdv->cp); ?></td> -->
									<td class=""><?php echo e($rdv->ville); ?></td>
									<td class=""><?php echo e($rdv->telephone); ?></td>
									<!-- <td class=""><?php echo e($rdv->mobile); ?></td>
									<td class=""><?php echo e($rdv->email); ?></td>
									<td class=""><?php echo e($rdv->age); ?></td>
									<td class=""><?php echo e($rdv->montant_impots_annuel); ?></td>
									<td class=""><?php echo e($rdv->taux_endettement); ?></td>
									<td class=""><?php echo e($rdv->statut_matrimonial); ?></td>
									<td class=""><?php echo e($rdv->composition_foyer); ?></td> -->
									<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->statut); ?></td>
									<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
									<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
									<!-- <td class=""><?php echo e($rdv->note); ?></td> -->

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\Ohmycrm\resources\views/rdvs/liste.blade.php ENDPATH**/ ?>