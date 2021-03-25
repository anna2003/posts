<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (isset($_GET['user_id']) && $user && $_GET['user_id'] == $user->id) {
    $posts = $dataAuth->posts($user->id);
} else {
    header('Location: /posts');
}

include $_SERVER['DOCUMENT_ROOT'] . '/profile/profile.view.php';

?>
<script>
    document.querySelector('#btn').addEventListener('click', function(e){
        e.preventDefault();
        console.log('pp.php/'+inputId.value);

        fetch('pp.php?' + new URLSearchParams({
            id: inputId.value
        })).then(data => data.text()).then(data=>console.log(data));
    });

</script>