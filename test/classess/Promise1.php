<?php
/**
 * Created by PhpStorm.
 * User: kuhool
 * Date: 2018/12/31
 * Time: 下午5:59
 */
// 尝试一
spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

class Promise1
{
    private $value;
    private $reason;
    private $state;

    public function __construct(\Closure $func = null)
    {
        $this->state = PromiseState::PENDING;
        $func([$this, 'resolve'], [$this, 'reject']);
    }

    /**
     * 执行回调方法里的resolve绑定的方法
     * @param null $value
     */
    public function resolve($value = null)
    {
        // 回调执行resolve传参的值，赋值给result
        $this->value = $value;
        if ($this->state == PromiseState::PENDING) {
            $this->state = PromiseState::FULFILLED;
        }
    }

    public function reject($reason = null)
    {
        // 回调执行resolve传参的值，赋值给result
        $this->reason = $reason;
        if ($this->state == PromiseState::PENDING) {
            $this->state = PromiseState::REJECTED;
        }
    }

    public function getState()
    {
        return $this->state;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getReason()
    {
        return $this->reason;
    }
}

$promise = new Promise1(function($resolve, $reject) {
    $resolve("打印我");
    $reject("reject :: 打印我");
});

//var_dump($promise->getState());
//var_dump($promise->getValue());
//var_dump($promise->getReason());

$test  = function($a,$b){var_dump($a,$b);};

$test(1,2);