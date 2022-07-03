let buttons = document.getElementsByClassName('ClickBTN');

for ( let i = 0; i < buttons.length; i++){
    buttons[i].onclick = function(e) {

        console.log(buttons.length);
        id = e.target.id;
        choice = e.target.title;

        let data = {
            id,
            choice
        }

        const response = fetch('http://localhost/app/post.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Accept': 'application/json',
            },

        })
        if (buttons.length === 2) {
            this.parentElement.parentElement.style.opacity = '0';
            this.parentElement.parentElement.style.visibility = 'hidden';
            this.parentElement.parentElement.style.transition = '0.55s opacity, 0.55s visibility';
            setTimeout(() => {
                this.parentElement.parentElement.remove()
                let div = document.getElementById('the_end');
                div.style.display = 'block';
                div.style.opacity = '1';
                div.style.transition = '0.55s opacity, 0.55s visibility';

            }, 500);

        } else {
            this.parentElement.parentElement.style.opacity = '0';
            this.parentElement.parentElement.style.visibility = 'hidden';
            this.parentElement.parentElement.style.transition = '0.55s opacity, 0.55s visibility';
            setTimeout(() => this.parentElement.parentElement.remove(), 500);
        }
    }
}


