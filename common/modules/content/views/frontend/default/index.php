<?php
\frontend\assets\LessonsAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-<?= $model->full ? '12' : '8' ?>">
            <div class="row">
                <section class="s-default">
                    <div class="container">
                        <div class="b-content">
                            <?= $model->description ?>
                        </div>
                    </div>
                </section>
                <?php if ($images = $model->getFiles('images')): ?>
                    <section class="s-default">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="s-default__title h3">Наши тренировки</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="s-default__row s-default__row_mb_24 row">
                                        <?php foreach ($images as $image) : ?>
                                            <div class="s-default__col col-sm-6">
                                                <a href="<?= $image->url ?>" class="picture" data-lightbox="img">
                                                    <img src="<?= $image->sizes['preview']['url'] ?>"
                                                         class="picture__img" alt="<?= $image->content->description ?>"
                                                         title="<?= $image->content->title ?>">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!$model->full) : ?>
            <div class="col-lg-4">
                <div class="rails-right">
                    <div class="rails-right__block">
                        <div class="survey-form">
                            <h2 class="survey-form__title h4"><?= $model->sideTitle ?></h2>
                            <div class="survey-form__desc b-content">
                                <p><?= $model->sideText ?></p>
                            </div>
                            <a href="<?= $model->sideUrl ?>"
                               class="survey-form__btn btn btn_blue"><?= $model->sideBtn ?></a>
                        </div>
                    </div>

                    <a href="<?= $model->sideUrl ?>" class="rails-right__button btn btn_blue"><?= $model->sideBtn ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>