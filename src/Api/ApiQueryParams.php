<?php

namespace Getsno\Relesys\Api;

class ApiQueryParams
{
    protected array $filters = [];

    protected array $sort = [];

    protected int $limit = 200;

    protected int $offset = 0;

    public function addFilter(string $field, mixed $value, FilterOperator $operator = FilterOperator::eq): self
    {
        $this->filters[] = (object) [
            'field'    => $field,
            'value'    => $value,
            'operator' => $operator->name,
        ];

        return $this;
    }

    public function sortBy(string $field, bool $isAsc = true): self
    {
        $this->sort[] = $isAsc ? $field : "-$field";

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function toArray(): array
    {
        $params = [];

        if (!empty($this->filters)) {
            foreach ($this->filters as $filter) {
                $params["$filter->field[$filter->operator]"] = $filter->value;
            }
        }

        if (!empty($this->sort)) {
            $params['sort'] = implode(',', $this->sort);
        }

        $params['limit'] = $this->limit;

        $params['offset'] = $this->offset;

        return $params;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getSort(): array
    {
        return $this->sort;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
