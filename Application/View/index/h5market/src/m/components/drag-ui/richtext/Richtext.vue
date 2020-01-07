<template>
    <div class="ks-pt10">
        <div class="md-richtext" v-html="dataCode"></div>
    </div>
</template>
<script>
export default {
    name:'KdRichtext',
    props:[
        'dataCode'
    ]
}

</script>
<style>
.md-richtext{padding: 10px; background: #fff;}
.md-richtext{line-height: 2;font-size:14px;}
.md-richtext p,
.md-richtext .md-richtext-title{padding:5px 0;}
.md-richtext img{max-width: 100% !important; }
.md-richtext .md-richtext-title{font-size: 18px;font-weight: bold; line-height: 24px;}

</style>
