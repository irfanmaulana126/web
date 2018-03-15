<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Supplier */
?>
<div class="supplier-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'SUPPLIER_NM',
            'label'=>'SUPPLIER'  ],
            ['attribute'=>'PIC',
            'label'=>'PIC'  ],
           ['attribute'=>'ALAMAT',
            'label'=>'ALAMAT'  ],
           ['attribute'=>'EMAIL',
            'label'=>'EMAIL'  ],
           ['attribute'=>'NO_TLP',
            'label'=>'Telephone'  ],
           ['attribute'=>'PHONE',
            'label'=>'PHONE'  ],
           ['attribute'=>'DCRP_DETIL',
            'label'=>'DCRP_DETIL'  ],
        ],
    ]) ?>

</div>
