<?php
namespace ZunFuyuzora\UkyoTable;

use Illuminate\Http\Request;
use ZunFuyuzora\UkyoTable\Contracts\UkyoModel;
use ZunFuyuzora\UkyoTable\Datatypes\BaseData;
use ZunFuyuzora\UkyoTable\Datatypes\DatatableRequest;


/**
 * UkyoTable wording
 *
 * Ukyo! From this Request, take records of Model
 * but Don't Handle Keyword Search, (optional)
 * also Don't Handle Field Selection, (optional)
 * if its return a total data per page, Obey! (default)
 * order the field as this $array (default | optional)
 *
 *
 */

class UkyoTable {
    public $payload;
    public UkyoModel $model;
    public $options;
    public $customAttribute;

    public function __construct(Request $request) {
        $this->payload = new DatatableRequest($request);
    }

    /**
     * Create Datatable from HTTP Request
     *
     * @param Request $request
     * @return static
     */
    public static function from(Request $request): static {
        return new static($request);
    }

    public function keyword() {
        //
    }

    public function get(string | UkyoModel $model) {
        if (gettype($model) == "string") {
            $model = new $model;
        }
        $this->setModel($model);
        return $this;
    }

    public function getRequestArray()
    {
        $i = $this->payload;
        $s = $i->search;
        $c = $i->columns;
        $o = $i->order;
        return [
            'draw' => $i->draw,
            'search' => $s->toArray(),
            'columns' => $c->toArray(),
            'order' => $o->toArray()
        ];
    }

    public function callQuery($payload)
    {
        $offset = $payload->start;
        $limit = $payload->length;
        $query = $this->model
            ->ukyoGather();
        $count = $query->count();
        $rows = $query->UkyoOrder($payload->order)->pick($offset, $limit)
            ->get()
            ;
        return compact('count', 'rows');
    }

    public function getResponseArray()
    {
        $result = $this->callQuery($this->payload);
        $count = $result['count'];
        $payload = $this->payload;
        $records = [];
        $result['rows']->map(function ($v, $k) use (&$payload, &$records, &$num) {
            $data = [];
            $item = $v;
            foreach($payload->getColumnsData() as $name) {
                $data[$name] = $item->{$name};
            }
            $records[] = $data;
        });
        return $this->response($records, $count);
    }

    public function response($records, $count) {
        $draw = $this->payload->draw;
        $recordsFiltered = $recordsTotal = $count;
        $data = $records;
        return compact('draw', 'recordsFiltered', 'recordsTotal', 'data');
    }

    /**
     * Set Model: UkyoModel
     *
     * @param UkyoModel $model
     * @return void
     */
    protected function setModel(UkyoModel $model) {
        $this->model = $model;
    }

    public function withOptions(array $options) {
        $this->options = $options;
        return $this;
    }

    public function withCustomAttribute(array $attr) {
        $this->customAttribute = $attr;
        return $this;
    }

    public function compile($data)
    {
        $nomor_urut = $this->start + 1;
        foreach ($data as $row) {
            $actionBtn = '
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"  dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">Action <i class="fa fa-caret-down" style="margin-left:5px;"></i></button>

                <div class="dropdown-menu" role="menu" style="">';
            $actionBtn = $actionBtn . '
                    <a class="dropdown-item" href="' . route('admin.banners.edit', $row->id) . '"><i class="fa fa-edit" style="margin-right:5px;"></i>Edit</a>';
            $actionBtn = $actionBtn . '
                    </div>
            </div>';
            $output['data'][] = array(
                $nomor_urut, formatDatetime($row->created_at), $actionBtn
            );
            $nomor_urut++;
        }
        return response()->json($output);
    }
}

//

///

/**
 * use ZunFuyuzora/UkyoTable/DataTable
 *
 * DataTable::query()
 *
 */
