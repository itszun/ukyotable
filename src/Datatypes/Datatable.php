<?php

namespace App\Datatypes;

use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Http\Request;

abstract class Datatable extends BaseData
{
    protected $context;
    protected $column_order = array("id");
    protected $draw;
    protected $length;
    protected $start;
    protected $order;
    protected $dir;
    protected $default_column = 0;
    protected $data;
    protected $recordsTotal;
    protected $recordsFiltered;


    /**
     * This constructor will do any hassle for handling common operation
     * for Datatable
     *
     */
    final public function __construct(Request $request)
    {
        $this->user = $request->user();
        $this->draw = $request->draw;
        $this->length = $request->length;
        $this->start = $request->start;

        $this->order = $request->order['0']['column'];
        $this->dir = $request->order['0']['dir'];
        $this->keyword = '%' . strtolower(strip_tags(trim($request->keyword))) . '%';

        $this->order_by = $this->column_order[$this->order] ?? $this->default_column;

        return $this;
    }

    public function init()
    {
        return true;
    }

    final public function render()
    {
        $this->recordsTotal = $this->recordsFiltered = $this->total_query();
        return $this->compile($this->get_query()->toArray());
    }

    protected function compile($data)
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

    abstract public function total_query(): int;
    abstract public function get_query();
    abstract public function DatatableKeyword($query);

    final protected function Wrap($query)
    {
        return $this->DatatableKeyword($this->DatatableWrap($query));
    }

    public function DatatableWrap($query)
    {
        return $query->offset($this->start)
            ->limit($this->length)
            ->orderBy($this->byColumn(), $this->dir);
    }


    public function byColumn()
    {
        return $this->column_order[$this->order] ?? $this->default_column;
    }
}
