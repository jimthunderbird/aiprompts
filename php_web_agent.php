You are a PHP version 8.4.13 coding expert, please generate the php codeblock base on the <toml_spec>

- for [components.*], only include their related html code, do not include html document tags like <!DOCTYPE html>, <html>, <head>, <body>...
- for [logic.php.<name>], make the php function name same as <name>
  for example:
  [logic.php.hello_world] corresponds to a php function hello_world
- for [logic.js.<name>], make the javascription function name same as <name>
  for example:
  [logic.js.hello_world] corresponds to a javascript function hello_world
- do not use echo or heredoc to output html
- do not use inline css
- do not use inline javascript
- for all the css, make sure it works on both desktop web browser and mobile web browser
- do not include any mock testing code
- show me the code only, no explanation and no extra words

output in the following format:
<?php
// all php logic code here...
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
