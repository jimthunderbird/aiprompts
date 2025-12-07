<?php ob_start(); ?>

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

<?php
$final_content = ob_get_contents();
file_put_contents("tmp.prompt", $final_content);
ob_end_clean();

$prompt_response_content = shell_exec("copilot -p \"\$(cat tmp.prompt)\"");

$marker = "```php";

$position = strpos($prompt_response_content, $marker);

if ($position !== false) {
    $prompt_response_content = substr($prompt_response_content, $position);
}

$prompt_response_content = str_replace(["```php","```"],"", $prompt_response_content);

file_put_contents("index.php", $prompt_response_content);
