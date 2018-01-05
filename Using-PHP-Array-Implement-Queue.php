<?php

interface Queue {

    public function enqueue(string $item);

    public function dequeue();

    public function peek();

    public function isEmpty();
}

class AgentQueue implements Queue {

    /**
     * 队列长度
     * @var int
     */
    private $limit;
    /**
     * 队列
     * @var array
     */
    private $queue;

    /**
     * AgentQueue constructor.
     * @param int $limit
     */
    public function __construct(int $limit = 20) {
        $this->limit = $limit;
        $this->queue = [];
    }

    /**
     * 从头部出列
     * @return string
     */
    public function dequeue(): string {

        if ($this->isEmpty()) {
            throw new UnderflowException('Queue is empty');
        } else {
            return array_shift($this->queue);
        }
    }

    /**
     * 从尾部入列
     * @param string $newItem
     */
    public function enqueue(string $newItem) {

        if (count($this->queue) < $this->limit) {
            array_push($this->queue, $newItem);
        } else {
            throw new OverflowException('Queue is full');
        }
    }

    /**
     * 获取当前元素的值
     * @return string
     */
    public function peek(): string {
        //PHP知识点:current默认数组第一个元素,可用next和prev移动数组指针
        return current($this->queue);
    }

    /**
     * 判断是否为空
     * @return bool
     */
    public function isEmpty(): bool {
        return empty($this->queue);
    }

}

try {
    $agents = new AgentQueue(10);
    $agents->enqueue("Fred");
    $agents->enqueue("John");
    $agents->enqueue("Keith");
    $agents->enqueue("Adiyan");
    $agents->enqueue("Mikhael");
    echo $agents->dequeue()."\n";
    echo $agents->dequeue()."\n";
    echo $agents->peek()."\n";
} catch (Exception $e) {
    echo $e->getMessage();
}
