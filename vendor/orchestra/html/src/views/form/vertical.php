<?php

echo Form::open(array_merge($form, array('class' => 'form-vertical')));

if ($token) echo Form::token();

foreach ($hiddens as $hidden) echo $hidden;

foreach ($fieldsets as $fieldset) { ?>

    <fieldset<?php echo HTML::attributes($fieldset->attributes ?: array()); ?>>

        <?php if( $fieldset->name ) : ?><legend><?php echo $fieldset->name ?: '' ?></legend><?php endif; ?>

        <?php foreach ($fieldset->controls() as $control) { ?>

        <div class="form-group<?php echo $errors->has($control->name) ? ' has-error' : '' ?>">
            <?php echo Form::label($control->name, $control->label); ?>
            <div>
                <?php echo call_user_func($control->field, $row, $control, array()); ?>
                <?php if( $control->inlineHelp ) : ?><span class="help-inline"><?php echo $control->inlineHelp; ?></span><?php endif; ?>
                <?php if( $control->help ) : ?><p class="help-block"><?php echo $control->help; ?></p><?php endif; ?>
                <?php echo $errors->first($control->name, $errorMessage); ?>
            </div>
        </div>

        <?php } ?>

    </fieldset>
<?php } ?>


<fieldset>
    <div class="row">
        <?php /* Fixed row issue on Bootstrap 3 */ ?>
    </div>
    <div class="row">
        <div class="twelve columns">
            <button type="submit" class="btn btn-primary"><?php echo $submit; ?></button>
        </div>
    </div>
</fieldset>


<?php echo Form::close(); ?>
