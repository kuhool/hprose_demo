<?php
/**
 * Created by PhpStorm.
 * User: kuhool
 * Date: 2019/1/1
 * Time: 下午7:57
 */
spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});
// 尝试二 （增加链式then）
class Promise2
{
    private $value;
    private $reason;
    private $state;

    public function __construct(\Closure $func = null)
    {
        $this->state = PromiseState::PENDING;

        $func([$this, 'resolve'], [$this, 'reject']);
    }

    public function then(\Closure $onFulfilled = null, \Closure $onRejected = null)
    {
        // 如果状态是fulfilled，直接回调执行并传参value
        if ($this->state == PromiseState::FULFILLED) {
            $onFulfilled($this->value);
        }

        // 如果状态是rejected，直接回调执行并传参reason
        if ($this->state == PromiseState::REJECTED) {
            $onRejected($this->reason);
        }

        // 返回对象自身，实现链式调用
        return $this;

    }

    /**
     * 执行回调方法里的resolve绑定的方法
     * 本状态只能从pending->fulfilled
     * @param null $value
     */
    public function resolve($value = null)
    {
        if ($this->state == PromiseState::PENDING) {
            $this->state = PromiseState::FULFILLED;
            $this->value = $value;
        }
    }

    /**
     * 执行回调方法里的rejected绑定的方法
     * 本状态只能从pending->rejected
     * @param null $reason
     */
    public function reject($reason = null)
    {
        if ($this->state == PromiseState::PENDING) {
            $this->state = PromiseState::REJECTED;
            $this->reason = $reason;
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



$promise = new Promise2(function($resolve, $reject) {
    $resolve("打印我");
});

$promise->then(function ($value) {
    var_dump($value);
}, function ($reason) {
    var_dump($reason);
})->then(function ($value) {
    var_dump($value);
}, function ($reason) {
    var_dump($reason);
});