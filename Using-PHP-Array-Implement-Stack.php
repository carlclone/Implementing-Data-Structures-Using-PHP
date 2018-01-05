<?php



//堆栈,简单很多,入栈,出栈,获取最上面的元素,判断是否为空

interface Stack {

    public function push(string $item);

    public function pop();

    public function top();

    public function isEmpty();
}

// 书本例子

/**
 * Class Books
 */
class Books implements Stack {

    /**
     * 栈的大小
     * @var int
     */
    private $limit;
    /**
     * 栈实体,用数组实现
     * @var array
     */
    private $stack;

    /**
     * Books constructor.
     * @param int $limit
     */
    public function __construct(int $limit = 20) {
        $this->limit = $limit;
        $this->stack = [];
    }

    /**
     * 使用数组的array_pop弹出
     * @return string
     */
    public function pop(): string {

        if ($this->isEmpty()) {
            throw new UnderflowException('Stack is empty');
        } else {
            return array_pop($this->stack);
        }
    }

    /**
     * 使用数组的array_push插入
     * @param string $newItem
     */
    public function push(string $newItem) {

        if (count($this->stack) < $this->limit) {
            array_push($this->stack, $newItem);
        } else {
            throw new OverflowException('Stack is full');
        }
    }

    /**
     * end()取出数组最后一个
     * @return string
     */
    public function top(): string {
        return end($this->stack);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool {
        return empty($this->stack);
    }

}


try {
    $programmingBooks = new Books(10);
    $programmingBooks->push("Introduction to PHP7");
    $programmingBooks->push("Mastering JavaScript");
    $programmingBooks->push("MySQL Workbench tutorial");
    echo $programmingBooks->pop()."\n";
    echo $programmingBooks->top()."\n";
} catch (Exception $e) {
    echo $e->getMessage();
}