<?php require_once "php_web_system_instruction.txt"; ?>

output in the following format:
<?php
echo <<<CODE
<?php
// all php logic code here...
?>
CODE;
?>

<script>
// all javascript code here...
</script>

<style>
//all css code here
</style>

Here is the <toml_spec>:

<?php
echo file_get_contents("./toml_html_component_spec.toml");
?>
