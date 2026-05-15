@extends('layouts.app')

@section('content')
    <section class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="max-w-3xl">
                <p class="text-sm font-semibold uppercase text-emerald-700">About Us</p>
                <h1 class="mt-3 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Smarter irrigation support for farmers, providers, and device makers
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 sm:text-lg">
                    Our platform brings together irrigation monitoring, service discovery, and connected devices in one place.
                    Farmers can track field conditions, service providers can manage requests, and manufacturers can support
                    the devices that keep farms running efficiently.
                </p>
            </div>
        </div>
    </section>

    <section class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-3">
                <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-emerald-100 text-emerald-700">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m9-9H3" />
                        </svg>
                    </div>
                    <h2 class="mt-5 text-lg font-semibold text-gray-900">Connected monitoring</h2>
                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        View soil moisture, temperature, and water flow data so irrigation decisions are based on current field conditions.
                    </p>
                </article>

                <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-blue-100 text-blue-700">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 11h14M7 21h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="mt-5 text-lg font-semibold text-gray-900">Service coordination</h2>
                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        Match farmers with nearby irrigation professionals and keep service requests organized from one dashboard.
                    </p>
                </article>

                <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-amber-100 text-amber-700">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 21l3-2 3 2-.75-4M7 4h10l1 7H6l1-7zm1 7h8a4 4 0 01-8 0z" />
                        </svg>
                    </div>
                    <h2 class="mt-5 text-lg font-semibold text-gray-900">Shared visibility</h2>
                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        Give every role the information they need, from farmer activity to provider availability and device oversight.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-white py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
                <div>
                    <p class="text-sm font-semibold uppercase text-emerald-700">How We Help</p>
                    <h2 class="mt-3 text-2xl font-bold text-gray-900">Built for practical farm operations</h2>
                    <p class="mt-4 leading-7 text-gray-600">
                        We focus on tools that support day-to-day decisions. Instead of scattered updates and manual follow-ups,
                        the platform keeps irrigation data, device status, and service activity in one workflow.
                    </p>

                    <div class="mt-6 space-y-4">
                        <div class="flex gap-4">
                            <div class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-emerald-500"></div>
                            <div>
                                <h3 class="font-semibold text-gray-900">For farmers</h3>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Monitor conditions, control irrigation, and request support when field work needs attention.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-blue-500"></div>
                            <div>
                                <h3 class="font-semibold text-gray-900">For service providers</h3>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Publish services, receive requests, and manage work with clearer context from the start.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-amber-500"></div>
                            <div>
                                <h3 class="font-semibold text-gray-900">For manufacturers</h3>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Keep device information organized and help ensure connected equipment stays useful in the field.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="rounded-lg bg-gray-900 p-6 text-white shadow-sm">
                    <p class="text-sm font-semibold uppercase text-emerald-300">Our Values</p>
                    <dl class="mt-6 space-y-5">
                        <div>
                            <dt class="text-lg font-semibold">Reliability</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-300">
                                Useful information should be easy to access when decisions need to be made quickly.
                            </dd>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold">Clarity</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-300">
                                Interfaces should reduce guesswork, not add more of it.
                            </dd>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold">Collaboration</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-300">
                                Better irrigation outcomes come from farmers, providers, and makers working from the same picture.
                            </dd>
                        </div>
                    </dl>
                </aside>
            </div>
        </div>
    </section>
@endsection
