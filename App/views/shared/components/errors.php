<?php
function renderInputField($name, $label, $type = 'text', $errors = [], $value = '')
{
   $isInvalid = isset($errors[$name]) ? ' is-invalid' : '';
   $inputValue = htmlspecialchars($value);
?>
   <label for="<?php echo $name; ?>" class="form-label visually-hidden"><?php echo $label; ?></label>
   <input
      type="<?php echo $type; ?>"
      class="form-control <?php echo $isInvalid; ?>"
      name="<?php echo $name; ?>"

      id="<?php echo $name; ?>"
      placeholder="<?php echo $label; ?>"
      value="<?php echo $inputValue; ?>" />
   <?php if (isset($errors[$name])): ?>
      <div class="invalid-feedback">
         <?php foreach ($errors[$name] as $error): ?>
            <p style="margin: 0;"><?php echo htmlspecialchars($error); ?></p>
         <?php endforeach; ?>
      </div>
   <?php endif; ?>
<?php
}
?>