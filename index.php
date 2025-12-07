
<?php
function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    $questions = array_slice($questions, 0, 2);
    return $questions;
}

function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    $questions = array_slice($questions, 0, 2);
    return $questions;
}

$questions_table_data = component_questions_table_datasource();
$questions_list_data = get_random_questions();
?>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $row_index = 1; ?>
        <?php foreach ($questions_table_data as $question): ?>
        <tr>
            <td data-row="<?php echo $row_index; ?>" data-col="1" data-body="<?php echo htmlspecialchars($question['body']); ?>"><?php echo htmlspecialchars($question['id']); ?></td>
            <td data-row="<?php echo $row_index; ?>" data-col="2" data-body="<?php echo htmlspecialchars($question['body']); ?>"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php $row_index++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php $para_index = 0; ?>
    <?php foreach ($questions_list_data as $question): ?>
    <p class="<?php echo ($para_index % 2 == 0) ? 'even' : 'odd'; ?>"><?php echo htmlspecialchars($question['id'] . ': ' . $question['body']); ?></p>
    <?php $para_index++; ?>
    <?php endforeach; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('questions-table');
    const cells = table.querySelectorAll('tbody td');
    
    cells.forEach(cell => {
        cell.addEventListener('click', function(e) {
            const rowNum = this.getAttribute('data-row');
            const colNum = this.getAttribute('data-col');
            const questionBody = this.getAttribute('data-body');
            alert('question details: ' + questionBody + ' (' + rowNum + ', ' + colNum + ')');
        });
        
        cell.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
        });
        
        cell.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
    });
});
</script>

<style>
#questions-table {
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    table-layout: auto;
}

#questions-table thead th {
    background: lightyellow;
    text-align: left;
    padding: 8px;
    border: 1px solid gold;
}

#questions-table tbody td {
    background: wheat;
    text-align: center;
    padding: 8px;
    border: 1px solid gold;
    cursor: pointer;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 8px;
}

#questions-list p.odd {
    background: lightcoral;
}

#questions-list p.even {
    background: red;
    color: white;
}

@media screen and (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 6px;
    }
    
    #questions-list p {
        font-size: 14px;
        margin-left: 5px;
        margin-right: 5px;
    }
}

@media screen and (max-width: 480px) {
    #questions-table {
        font-size: 12px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 4px;
    }
    
    #questions-list p {
        font-size: 12px;
    }
}
</style>


