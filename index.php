
<?php
function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

function component_questions_list_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 4);
}

function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

$questions_table_data = component_questions_table_datasource();
$questions_list_data = component_questions_list_datasource();
?>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions_table_data as $index => $question): ?>
        <tr data-row="<?php echo $index + 1; ?>">
            <td data-col="1"><?php echo htmlspecialchars($question['id']); ?></td>
            <td data-col="2"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php foreach ($questions_list_data as $index => $question): ?>
    <p class="<?php echo ($index % 2 === 0) ? 'even' : 'odd'; ?>" data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'>
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('questions-table');
    if (table) {
        table.addEventListener('click', function(e) {
            const cell = e.target.closest('td');
            if (cell) {
                const row = cell.closest('tr');
                const rowNumber = row.dataset.row;
                const colNumber = cell.dataset.col;
                const questionBody = row.cells[1].textContent;
                alert(`question details: ${questionBody} (${rowNumber}, ${colNumber})`);
            }
        });

        const cells = table.querySelectorAll('td');
        cells.forEach(cell => {
            cell.addEventListener('mouseenter', function() {
                this.style.fontWeight = 'bold';
            });
            cell.addEventListener('mouseleave', function() {
                this.style.fontWeight = 'normal';
            });
        });
    }

    const listSection = document.getElementById('questions-list');
    if (listSection) {
        const paragraphs = listSection.querySelectorAll('p');
        paragraphs.forEach(p => {
            p.addEventListener('mouseenter', function() {
                this.style.fontWeight = 'bold';
                this.style.cursor = 'wait';
            });
            p.addEventListener('mouseleave', function() {
                this.style.fontWeight = 'normal';
                this.style.cursor = 'default';
            });
        });
    }
});
</script>

<style>
#questions-table {
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
}

#questions-table th {
    background: lightyellow;
    text-align: left;
    padding: 8px;
    border: 1px solid gold;
}

#questions-table td {
    background: wheat;
    text-align: center;
    padding: 8px;
    border: 1px solid gold;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
}

#questions-list p.odd {
    background: lightcoral;
}

#questions-list p.even {
    background: red;
    color: white;
}

@media (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table th,
    #questions-table td {
        padding: 6px;
    }
    
    #questions-list p {
        margin-left: 5px;
        margin-right: 5px;
        padding: 8px;
        font-size: 14px;
    }
}
</style>


