new Vue({
    el: '#app',

    data: {
        completed: true
    },

    methods: {
        save(id) {
            fetch('/tasks/' + id + '/complete', {
                method: 'PATCH',
                body: this.completed
            });
        }
    }
})