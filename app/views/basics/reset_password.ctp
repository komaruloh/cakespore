<div id="form-login">
    <fieldset>
    <?php 
        echo $form->create(null, array('action'=>'resetPassword'));
        echo $form->input('useroremail', array('label'=>__('Username or email', true), 'maxlength'=>'100'));
        echo $form->submit('Submit', array('div'=>false)) . "&nbsp;";
        echo $html->link('Back', array('action'=>'anon'), array('class'=>'back'));
        echo $form->end();
    ?>
    <br />
    </fieldset>
</div>
