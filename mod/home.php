<?
route('/',function ($arg){
    template('index');
});

route('/hello/:name','hello');
function hello($arg)
{
    echo "hello,".$arg['name'];
}