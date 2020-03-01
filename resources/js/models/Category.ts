export interface CategoryProperty {
    id: number;
    name: string;
    created_at: Date;
    updated_at: Date;
    pivot: any;
    dishes: Array<any>;
}

export default class Category {
    id: number;
    name: string;
    created_at: Date;
    updated_at: Date;
    pivot: any;
    dishes: Array<any>;

    constructor(props: CategoryProperty) {
        this.id = props.id;
        this.name = props.name;
        this.created_at = props.created_at;
        this.updated_at = props.updated_at;
        this.pivot = props.pivot;
        this.dishes = props.dishes;
    }
}