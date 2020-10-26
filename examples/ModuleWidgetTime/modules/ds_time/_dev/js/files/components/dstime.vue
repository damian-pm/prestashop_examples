<template>
    <div class="megam-box">
        <p>
            <a v-bind:href=url>{{url}}</a>
        </p>
        <h3>Time: {{datetime}}</h3>
    </div>
</template>

<script>

import $ from 'jquery';

export default {
    name: 'dstime',
    props: {},
    data: () => {
        return {
            url:'',
            datetime: 0
        }
    },
    created: function(){
        let a = document.getElementById('mbox').getAttribute('data-url');
        this.url = $('#mbox').data('url');
    },
    methods: {
        timer: function() {
            this.datetime = new Date().toLocaleString();
            window.setTimeout( this.timer, 1000)
        }
    },
    mounted() {
        this.timer();
    }
}
</script>
