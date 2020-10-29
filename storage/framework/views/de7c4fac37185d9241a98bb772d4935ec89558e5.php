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
    <?php
    $blink = \App\BlinkStatut::all();
    $rdvBrut=$rdvRfRl=$rdvRfNl=$rdvEnv=$rdvConf=$rdvAnnul=$rdvAtt=$rdvValid=null;
    foreach ($blink as $item){
        if ($item->typerdv=='Rendez-vous brut'){$rdvBrut=$item->isunread;}
        if ($item->typerdv=='Rendez-vous relancer'){$rdvRfRl=$item->isunread;}
        if ($item->typerdv=='Rendez-vous refusé'){$rdvRfNl=$item->isunread;}
        if ($item->typerdv=='Rendez-vous envoyé'){$rdvEnv=$item->isunread;}
        if ($item->typerdv=='Rendez-vous confirmé'){$rdvConf=$item->isunread;}
        if ($item->typerdv=='Rendez-vous annulé'){$rdvAnnul=$item->isunread;}
        if ($item->typerdv=='Rendez-vous en attente'){$rdvAtt=$item->isunread;}
        if ($item->typerdv=='Rendez-vous validé'){$rdvValid=$item->isunread;}
    }
    ?>
<div class="row">
    <div class="col-md-3">
        <!-- TYPE RENDEZ-VOUS -->
        <div class="box box-solid <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Type de production</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo e($typerdv=='tout' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tout">
                        <a href="tout">
                            <i class="fa fa-cubes"></i> Tout
                            <span class="label label-danger pull-right"><?php echo e(count($rendezvoustout)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Défiscalisation' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tp,Défiscalisation">
                        <a nohref href="#" >
                            <i class="fa fa-money"></i> Défiscalisation
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsdefiscalisation)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Nettoyage pro' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tp,Nettoyage pro">
                        <a nohref href="#">
                            <i class="fa fa-eraser"></i> Nettoyage pro
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsnettoyagepro)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Assurance pro' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tp,Assurance pro">
                        <a nohref href="#">
                            <i class="fa fa-ticket"></i> Assurance pro
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsassurancepro)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Mutuelle santé sénior' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tp,Mutuelle santé sénior" >
                        <a nohref href="#">
                            <i class="fa fa-universal-access"></i> Mutuelle santé sénior
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsmutuellesantesenior)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Autres' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tp,Autres">
                        <a nohref href="#" >
                            <i class="fa fa-adjust"></i> Autres
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsautre)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Réception d\’appels' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tp,Réception d\’appels">
                        <a nohref href="#" >
                            <i class="fa fa-phone"></i> Réception d’appels
                            <span class="label label-danger pull-right"><?php echo e(count($appels)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($typerdv=='Demande de devis' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tp,Demande de devis">
                        <a >
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
                    <li class="<?php echo e($typerdv=='tout' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="tout">
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
                    <li class="<?php echo e($statutrdv=='Rendez-vous brut' ? 'active' : ''); ?> <?php echo e($rdvBrut=="oui"?"blink":''); ?>  <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?> statutrdvclick" data-statutrdvclick="Rendez-vous brut">
                        <a nohref   href="#">
                            <i class="fa fa-cube"></i> Rendez-vous brut
                            <span class="label label-danger pull-right">
                            <?php echo e(count($rdvsbrut)); ?>

                            <!-- <?php if(Auth::user()->statut == 'Superviseur'): ?>
                                xx <?php echo e($rdvsbrut->countBy('user_statut')->count()); ?> yy
                            <?php endif; ?> -->
                            </span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous relancer' ? 'active' : ''); ?> <?php echo e($rdvRfRl=="oui"?"blink":''); ?>  <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
                            hidden <?php endif; ?> statutrdvclick" data-statutrdvclick="Rendez-vous relancer">
                        <a  nohref  href="#">
                            <i class="fa fa-thumbs-o-up"></i> Rendez-vous refusé / relancer
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsrelancer)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous refusé' ? 'active' : ''); ?>  <?php echo e($rdvRfNl=="oui"?"blink":''); ?> 
                    <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?> statutrdvclick"
                        data-statutrdvclick="Rendez-vous refusé">
                        <a  nohref   href="#">
                            <i class="fa fa-thumbs-o-down"></i> Rendez-vous refusé  / ne pas relancer
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsrefuse)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous envoyé' ? 'active' : ''); ?>  <?php echo e($rdvEnv=="oui"?"blink":''); ?> statutrdvclick" data-statutrdvclick="Rendez-vous envoyé">
                        <a nohref    href="#">
                            <i class="fa fa-send"></i> Rendez-vous envoyé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsenvoye)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous confirmé' ? 'active' : ''); ?> <?php echo e($rdvConf=="oui"?"blink":''); ?> statutrdvclick" data-statutrdvclick="Rendez-vous confirmé">
                        <a nohref   href="#">
                            <i class="fa fa-check-square-o"></i> Rendez-vous confirmé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsconfirme)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous annulé' ? 'active' : ''); ?>  <?php echo e($rdvAnnul=="oui"?"blink":''); ?> statutrdvclick" data-statutrdvclick="Rendez-vous annulé">
                        <a  nohref  href="#">
                            <i class="fa fa-arrow-left"></i> Rendez-vous annulé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsannule)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous en attente' ? 'active' : ''); ?>  <?php echo e($rdvAtt=="oui"?"blink":''); ?> statutrdvclick" data-statutrdvclick="Rendez-vous en attente">
                        <a nohref   href="#">
                            <i class="fa  fa-spinner"></i> Rendez-vous en attente
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsenattente)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?>  <?php echo e($rdvValid=="oui"?"blink":''); ?> statutrdvclick" data-statutrdvclick="Rendez-vous validé">
                        <a nohref   href="#">
                            <i class="fa fa-thumbs-up"></i> Rendez-vous validé
                            <span class="label label-danger pull-right"><?php echo e(count($rdvsvalide)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?>

                    <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?> statutrdvclick" data-statutrdvclick="Réception d’appels brut">
                        <a  nohref   href="#">
                            <i class="fa fa-phone-square"></i> Réception d’appels brut
                            <span class="label label-danger pull-right"><?php echo e(count($appelsbrut)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="Réception d’appels envoyé">
                        <a nohref   href="#">
                            <i class="fa fa-phone"></i> Réception d’appels envoyé
                            <span class="label label-danger pull-right"><?php echo e(count($appelsenvoye)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?>

                    <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?> statutrdvclick" data-statutrdvclick="Demande de devis brut">
                        <a nohref  href="#">
                            <i class="fa fa-list-alt"></i> Demande de devis brut
                            <span class="label label-danger pull-right"><?php echo e(count($devisbrut)); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e($statutrdv=='Rendez-vous validé' ? 'active' : ''); ?> statutrdvclick" data-statutrdvclick="Demande de devis envoyé">
                        <a nohref   href="#">
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

                <div class="box-tools pull-right">
                    <form id="exporttoexcel" action="<?php echo e(route('rdvs.exportexcel')); ?>" class="">
                        <?php echo csrf_field(); ?>
                        
                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-download"></i> Export total</button>
                    </form>
                </div> 
            </div>
            <div class="box-body no-padding">
                <!-- <div  class="table-responsive mailbox-messages"> -->
                <div  class="table-responsive box-body no-padding">
                    <br />
                    <div class="row">
                        <div class="input-daterange">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="start_date" id="start_date" placeholder="Date debut" class="form-control" autocomplete="off" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Date fin" autocomplete="off"/>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="button" name="search" id="searchdate" value="Filtrer" class="btn btn-info" />
                           <button class="btn btn-danger" id="refresh-tb"> <i class="fa fa-refresh" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <br />
                    <table id="empTables" class="table table-hover table-striped table2excel">
                        <thead class="theadexcel">
                            <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?>
                            <tr class="header">
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search "></th>
                                <th class="filter"><b>Référence</b></th>
                                <th class="filter"><b>Campagne en cours</b></th>
                                <th class="filter"><b>Société</b></th>
                                <th class="filter"><b>Ville</b></th>
                                <th class="filter"><b>Téléphone</b></th>
                                <th class="filter"><b>Nom de la personne au rendez-vous</b></th>
                                <th class="filter"><b>Qualification</b></th>
                                <th class="filter date"><b>Date rendez-vous</b></th>
                                <th class="filter"><b>Heure rendez-vous</b></th>
                                <th class="filter"><b>Date de création</b></th>
                                <th class="filter"><b>Dernière modification  </b></th>
                            </tr>
                            <?php elseif(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
                            <tr class="">
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>"></th>
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
                                <th class=""><b>Société</b></th>
                                <th class=""><b>Ville</b></th>
                                <th class=""><b>Téléphone</b></th>
                                <th class=""><b>Nom de la personne rendez-vous</b></th>
                                <th class="filter"><b>Qualification</b></th>
                                <th class="filter date"><b>Date rendez-vous</b></th>
                                <th class=""><b>Heure rendez-vous</b></th>
                                <th class="filter"><b>Rendez-vous pour</b></th>
                            </tr>
                            <?php endif; ?>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 50px;" class="noExl no-filter no-sort no-search <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>"></th>
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
                        </tfoot>

                    </table>
                    <button id="btnrdvexcel" class="btn btn-success btn-sm exportToExcel hidden ">Export excel</button>
                </div>
            </div>
        
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projet freelance\crm1\resources\views/rdvs/liste.blade.php ENDPATH**/ ?>