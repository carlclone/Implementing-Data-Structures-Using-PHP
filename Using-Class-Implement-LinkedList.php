<?php

/**
 * 链表节点
 */
class ListNode {
    /**
     * 节点数据
     * @var null|string
     */
    public $data = NULL;
    /**
     * 下一个节点的引用
     * @var null
     */
    public $next = NULL;

    /**
     * ListNode constructor.
     * @param string|NULL $data
     */
    public function __construct(string $data = NULL) {
        $this->data = $data;
    }

}

/**
 * 链表
 */
class LinkedList implements Iterator {

    /**
     * 第一个节点的引用
     * @var null
     */
    private $_firstNode = NULL;
    /**
     * 总节点数
     * @var int
     */
    private $_totalNode = 0;
    /**
     * 当前节点
     * @var null
     */
    private $_currentNode = NULL;
    /**
     * 当前位置
     * @var int
     */
    private $_currentPosition = 0;

    /**
     * 基本功能:插入新节点操作
     * 思路:找到最后一个节点,把引用复制给最后一个节点的next
     * 情况:链表中有0个节点 or 有多个节点
     * 关键:遍历链表的方法
     * @param string|NULL $data
     * @return bool
     */
    public function insert(string $data = NULL) {
        $newNode = new ListNode($data);

        //若没有第一节点,则直接把新节点设为第一
        if ($this->_firstNode === NULL) {
            $this->_firstNode = &$newNode;
        }  else {
            //否则把当前节点设为第一节点
            $currentNode = $this->_firstNode;
            //往下遍历节点找到一个下一节点为NULL的当前节点,边界条件NULL
            while ($currentNode->next !== NULL) {
                $currentNode = $currentNode->next;
            }
            //将新节点设为该当前节点的下一节点
            $currentNode->next = $newNode;
        }
        //节点计数加1
        $this->_totalNode++;
        //结束
        return TRUE;
    }

    /**
     * 基本功能:在链表头插入新节点
     * 思路: 新节点的next连接到当前第一节点(把新节点的引用赋值给第一节点, 把当前第一节点的引用赋值给新节点的next)
     * 情况:链表中有0个节点 or 有多个节点
     * @param string|NULL $data
     * @return bool
     */
    public function insertAtFirst(string $data = NULL) {
        $newNode = new ListNode($data);
        //若没有第一节点,则直接把新节点为第一
        if ($this->_firstNode === NULL) {
            $this->_firstNode = &$newNode;
        } else {
            //否则把新节点为第一节点,把当前的第一节点设为新节点的next
            $currentFirstNode = $this->_firstNode; //保存当前节点到新变量
            $this->_firstNode = &$newNode;
            $newNode->next = $currentFirstNode;
        }
        //计算加1
        $this->_totalNode++;
        //结束
        return TRUE;
    }

    /**
     * 基本功能:查找特定节点内容
     * 思路:遍历节点,内容匹配则返回节点
     * 情况:0个节点 or 多个节点
     * @param string|NULL $data
     * @return bool|null
     */
    public function search(string $data = NULL) {
        //如果有大于0个节点存在
        if ($this->_totalNode) {
            //使用一个容器存储当前节点位置
            $currentNode = $this->_firstNode;
            //遍历查找匹配内容的过程,边界条件NULL
            while ($currentNode !== NULL) {
                if ($currentNode->data === $data) {
                    return $currentNode;
                }
                $currentNode = $currentNode->next;
            }
        }
        //没有节点,返回false
        return FALSE;
    }

    /**
     * 基本功能:在某个内容的节点前插入
     * 思路:查找到目标节点,每次遍历保存上一节点 , 然后把上一节点的next指向新节点, 新节点的next指向目标节点
     * 情况:0个节点 or 查询失败 or 查询成功=>目标节点之前没有其他节点 or 有其他节点
     * @param string|NULL $data
     * @param string|NULL $query
     */
    public function insertBefore(string $data = NULL, string $query = NULL) {
        $newNode = new ListNode($data);

        if ($this->_firstNode) {
            $previous = NULL;
            $currentNode = $this->_firstNode;
            while ($currentNode !== NULL) {
                if ($currentNode->data === $query) {
                    $newNode->next = $currentNode;
                    $previous->next = $newNode;
                    $this->_totalNode++;
                    break;
                }
                $previous = $currentNode;
                $currentNode = $currentNode->next;
            }
        }
    }

    /**
     * 基本功能:在某个内容的节点后插入
     * 思路:遍历,找到目标节点,保存目标节点的next,目标节点的next指向新节点,新节点的next指向目标节点的原始next
     * 情况: 0个节点 or 查询失败 or 查询成功=>目标节点之后没有其他节点 or 有其他节点
     * @param string|NULL $data
     * @param string|NULL $query
     */
    public function insertAfter(string $data = NULL, string $query = NULL) {
        $newNode = new ListNode($data);

        if ($this->_firstNode) {
            $nextNode = NULL;
            $currentNode = $this->_firstNode;
            while ($currentNode !== NULL) {
                if ($currentNode->data === $query) {
                    if ($nextNode !== NULL) {
                        $newNode->next = $nextNode;
                    }
                    $currentNode->next = $newNode;
                    $this->_totalNode++;
                    break;
                }
                $currentNode = $currentNode->next;
                $nextNode = $currentNode->next;
            }
        }
    }

    /**
     * 基本功能:删除第一个节点(从链表头删除一个节点)
     * 思路:删除第一个节点,把下一个节点设为第一
     * 情况:0个节点 or 多个节点
     * @return bool
     */
    public function deleteFirst() {
        if ($this->_firstNode !== NULL) {
            if ($this->_firstNode->next !== NULL) {
                $this->_firstNode = $this->_firstNode->next;
            } else {
                $this->_firstNode = NULL;
            }
            $this->_totalNode--;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 基本功能:删除最后一个
     * 思路:把倒数第二个节点的next设为null (真的不删了最后一个节点释放空间吗?)
     * 情况:0个节点,一个节点,多个节点
     * @return bool
     */
    public function deleteLast() {
        if ($this->_firstNode !== NULL) {
            $currentNode = $this->_firstNode;
            if ($currentNode->next === NULL) {
                $this->_firstNode = NULL;
            } else {
                $previousNode = NULL;

                while ($currentNode->next !== NULL) {
                    $previousNode = $currentNode;
                    $currentNode = $currentNode->next;
                }

                $previousNode->next = NULL;
                $this->_totalNode--;
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * 基本功能:删除特点内容的节点
     * 思路:遍历链表找到节点,
     * 情况:未找到,找到,0个节点,1个节点,多个节点=>位置在第一个,在中间,在最后
     * @param string|NULL $query
     */
    public function delete(string $query = NULL) {
        if ($this->_firstNode) {
            $previous = NULL;
            $currentNode = $this->_firstNode;
            while ($currentNode !== NULL) {
                if ($currentNode->data === $query) {
                    if ($currentNode->next === NULL) {
                        $previous->next = NULL;
                    } else {
                        $previous->next = $currentNode->next;
                    }

                    $this->_totalNode--;
                    break;
                }
                $previous = $currentNode;
                $currentNode = $currentNode->next;
            }
        }
    }

    /**
     * 基本功能:翻转链表
     * 思路:翻转箭头指向,把第一个的next设为null , 后面的next设为前一个节点的引用,
     * 情况:
     */
    public function reverse() {
        if ($this->_firstNode !== NULL) {
            if ($this->_firstNode->next !== NULL) {
                $reversedList = NULL;
                $next = NULL;
                $currentNode = $this->_firstNode;
                while ($currentNode !== NULL) {
                    $next = $currentNode->next;
                    $currentNode->next = $reversedList;
                    $reversedList = $currentNode;
                    $currentNode = $next;
                }
                $this->_firstNode = $reversedList;
            }
        }
    }

    /**
     * 基本功能:获取第n个节点
     * 思路:遍历过程计数,第n次遍历即是第n个节点
     * 情况:n超出节点, 链表有0个节点,多个节点
     * @param int $n
     * @return null
     */
    public function getNthNode(int $n = 0) {
        $count = 1;
        if ($this->_firstNode !== NULL && $n <= $this->_totalNode) {
            $currentNode = $this->_firstNode;
            while ($currentNode !== NULL) {
                if ($count === $n) {
                    return $currentNode;
                }
                $count++;
                $currentNode = $currentNode->next;
            }
        }
    }

    /**
     * 基本功能:显示链表属性
     */
    public function display() {
        echo "Total book titles: " . $this->_totalNode . "\n";
        $currentNode = $this->_firstNode;
        while ($currentNode !== NULL) {
            echo $currentNode->data . "\n";
            $currentNode = $currentNode->next;
        }
    }

    /**
     * 获取链表size
     * @return int
     */
    public function getSize() {
        return $this->_totalNode;
    }

    /**
     * 获取当前节点内容
     * @return mixed
     */
    public function current() {
        return $this->_currentNode->data;
    }

    /**
     * 向下移动一位
     */
    public function next() {
        $this->_currentPosition++;
        $this->_currentNode = $this->_currentNode->next;
    }

    /**
     * 当前节点位置
     * @return int
     */
    public function key() {
        return $this->_currentPosition;
    }

    /**
     * 重置
     */
    public function rewind() {
        $this->_currentPosition = 0;
        $this->_currentNode = $this->_firstNode;
    }

    /**
     * 当前节点是否不为NULL
     * @return bool
     */
    public function valid() {
        return $this->_currentNode !== NULL;
    }

}

$BookTitles = new LinkedList();
$BookTitles->insert("Introduction to Algorithm");
$BookTitles->insert("Introduction to PHP and Data structures");
$BookTitles->insert("Programming Intelligence");
$BookTitles->insertAtFirst("Mediawiki Administrative tutorial guide");
$BookTitles->insertBefore("Introduction to Calculus", "Programming Intelligence");
$BookTitles->insertAfter("Introduction to Calculus", "Programming Intelligence");


foreach ($BookTitles as $title) {
    echo $title . "\n";
}


for ($BookTitles->rewind(); $BookTitles->valid(); $BookTitles->next()) {
    echo $BookTitles->current() . "\n";
}

/*
$BookTitles->display();
$BookTitles->deleteFirst();
$BookTitles->deleteLast();
$BookTitles->delete("Introduction to PHP and Data structures");
$BookTitles->reverse();
$BookTitles->display();
echo "2nd Item is: ".$BookTitles->getNthNode(2)->data;
 *
 */