import React, { useEffect } from 'react';
import Button from '@/Components/Button';
import Input from '@/Components/Input';
import Label from '@/Components/Label';
import { Head, Link, useForm } from '@inertiajs/inertia-react';
import ValidationErrors from '../ValidationErrors';


export default function Addcountry({ editForm }) {
    const { data, setData, setDefaults, post, processing, errors, reset, transform } = useForm({name: '', code: '', id: null });

    useEffect(() => {
        setData({name: editForm.name ?? '', code: editForm.code ?? '', id: editForm.id ?? null});
        // return () => {
        //     reset('name', 'code');
        // }
    }, [editForm?.id]);

    transform((data) => ({ ...data, id: editForm?.id }));

    const submit = (e) => {
        e.preventDefault();
        post(route('country'), {
            onSuccess: () => reset('name', 'code'),
        });
    };

    return (
        <div >
            <Head title="Add Country" />
            <div className="p-6 bg-slate-200 border-b border-gray-200">Add Country</div>
            <ValidationErrors errors={errors} />

            <form className="px-6" onSubmit={submit}>
                <div>
                    <Label forInput="name" value="Name" />
                    <Input
                        type="text"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="country"
                        isFocused={true}
                        handleChange={e => setData('name', e.target.value)}
                        required
                    />
                </div>
                <div className="mt-4">
                    <Label forInput="code" value="ISO" />
                    <Input type="text"
                    name="code"
                    value={data.code}
                    className="mt-1 block w-full" autoComplete="ISO"
                    handleChange={e => setData('code', e.target.value)}
                    required />
                </div>
                <div className="flex items-center justify-end mt-4">
                    <Button className="ml-4" processing={processing}>
                        Add
                    </Button>
                </div>
            </form>
        </div>
    )

}
