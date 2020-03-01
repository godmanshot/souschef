import Category from './Category';

export interface WeekProperty {
    id: number;
    name: string;
    start_at: Date;
    end_at: Date;
    hidden_if_expired: boolean;
    created_at: Date;
    updated_at: Date;
    categories: Array<Category>;
    pivot: any;
}

export class Week {
    id: number;
    name: string;
    start_at: Date;
    end_at: Date;
    hidden_if_expired: boolean;
    created_at: Date;
    updated_at: Date;
    categories: Array<Category>;
    pivot: any;

    constructor(props: WeekProperty) {
        this.id = props.id;
        this.name = props.name;
        this.start_at = props.start_at;
        this.end_at = props.end_at;
        this.hidden_if_expired = props.hidden_if_expired;
        this.created_at = props.created_at;
        this.updated_at = props.updated_at;
        this.categories = props.categories;
        this.pivot = props.pivot;
    }
}