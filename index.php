
<?php
function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $randomKeys = array_rand($questions, min(2, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    $result = [];
    foreach ($randomKeys as $key) {
        $result[] = $questions[$key];
    }
    return $result;
}

function component_questions_list_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $randomKeys = array_rand($questions, min(4, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    $result = [];
    foreach ($randomKeys as $key) {
        $result[] = $questions[$key];
    }
    return $result;
}

function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $randomKeys = array_rand($questions, min(2, count($questions)));
    if (!is_array($randomKeys)) {
        $randomKeys = [$randomKeys];
    }
    $result = [];
    foreach ($randomKeys as $key) {
        $result[] = $questions[$key];
    }
    return $result;
}

$questionsTableData = component_questions_table_datasource();
$questionsListData = component_questions_list_datasource();
?>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questionsTableData as $index => $question): ?>
        <tr data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'>
            <td><?php echo htmlspecialchars($question['id']); ?></td>
            <td><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php foreach ($questionsListData as $index => $question): ?>
    <p class="<?php echo ($index % 2 === 0) ? 'even' : 'odd'; ?>" data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'>
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</section>

<div id="question-popup"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questionPopup = document.getElementById('question-popup');
    const questionsTable = document.getElementById('questions-table');
    const questionsList = document.getElementById('questions-list');

    questionsTable.addEventListener('click', function(e) {
        const row = e.target.closest('tr');
        if (row && row.dataset.question) {
            const question = JSON.parse(row.dataset.question);
            questionPopup.textContent = question.body;
            questionPopup.style.visibility = 'visible';
        }
    });

    const cells = questionsTable.querySelectorAll('td');
    cells.forEach(cell => {
        cell.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
        });
        cell.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
    });

    const paragraphs = questionsList.querySelectorAll('p');
    paragraphs.forEach(paragraph => {
        paragraph.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
            this.style.cursor = 'wait';
        });
        paragraph.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
            this.style.cursor = 'default';
        });
        paragraph.addEventListener('click', function() {
            const question = JSON.parse(this.dataset.question);
            questionPopup.textContent = question.body;
            questionPopup.style.visibility = 'visible';
        });
    });

    questionPopup.addEventListener('click', function(e) {
        if (e.target === questionPopup) {
            questionPopup.style.visibility = 'hidden';
        }
    });

    document.addEventListener('click', function(e) {
        if (!questionPopup.contains(e.target) && !e.target.closest('#questions-table') && !e.target.closest('#questions-list')) {
            questionPopup.style.visibility = 'hidden';
        }
    });
});
</script>

<style>
#questions-table {
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
}

#questions-table thead th {
    background: lightyellow;
    text-align: left;
    padding: 10px;
    border: 1px solid gold;
}

#questions-table tbody td {
    background: wheat;
    text-align: center;
    padding: 10px;
    border: 1px solid gold;
}

#questions-list {
    max-width: 800px;
    margin: 20px auto;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
    cursor: default;
}

#questions-list p.odd {
    background: lightcoral;
}

#questions-list p.even {
    background: red;
    color: white;
}

#question-popup {
    width: 400px;
    height: 300px;
    background: #27CCF5;
    visibility: hidden;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-sizing: border-box;
    z-index: 1000;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

@media (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 8px;
    }
    
    #question-popup {
        width: 90%;
        max-width: 400px;
        height: auto;
        min-height: 200px;
    }
    
    #questions-list p {
        font-size: 14px;
        margin-left: 5px;
        margin-right: 5px;
    }
}
</style>


