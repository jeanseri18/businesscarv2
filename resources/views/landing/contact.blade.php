@extends('layouts.landing')

@section('title', 'Contact')
@section('description', 'Contactez Africa Business Card pour toute question sur nos offres, commissions ou pour devenir partenaire.')

@section('content')
<!-- Contact Hero -->
<section class="gradient-bg text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Contactez-nous</h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto">
            Une question sur nos offres ? Besoin d'assistance pour maximiser vos commissions ? Notre équipe est là pour vous aider.
        </p>
    </div>
</section>

<!-- Contact Information -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600">contact@africabusinesscard.com</p>
                <p class="text-gray-600">support@africabusinesscard.com</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Téléphone</h3>
                <p class="text-gray-600">+225 01 23 45 67</p>
                <p class="text-gray-600">WhatsApp: +225 XX XX XX XX</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Localisation</h3>
                <p class="text-gray-600">Abidjan, Côte d'Ivoire</p>
                <p class="text-gray-600">Disponible dans toute l'Afrique</p>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-gray-50 rounded-2xl p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Envoyez-nous un message</h2>
                
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                        <select id="subject" name="subject" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Sélectionnez un sujet</option>
                            <option value="information">Demande d'information</option>
                            <option value="offers">Questions sur les offres</option>
                            <option value="commissions">Questions sur les commissions</option>
                            <option value="partnership">Partenariat entreprise</option>
                            <option value="support">Support technique</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="6" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Décrivez votre demande..."></textarea>
                    </div>
                    
                    <button type="submit" 
                        class="w-full gradient-bg text-white py-4 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Questions fréquentes</h2>
        
        <div class="space-y-6">
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Comment publier une offre ?</h3>
                <p class="text-gray-600">Les entreprises peuvent publier des offres directement depuis leur tableau de bord. Les commerciaux peuvent ensuite promouvoir ces offres contre une commission.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Quels sont les modes de paiement acceptés ?</h3>
                <p class="text-gray-600">Nous acceptons les paiements par carte bancaire, mobile money (MTN, Moov, Orange Money) et virement bancaire.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Comment sont calculées les commissions ?</h3>
                <p class="text-gray-600">Les commissions sont définies par les entreprises lors de la publication de leurs offres. Elles sont versées après validation de la vente par notre équipe.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Comment fonctionne le marketplace B2B ?</h3>
                <p class="text-gray-600">Le marketplace permet aux entreprises de publier des offres et aux commerciaux de les promouvoir contre une commission. C'est une plateforme de vente collaborative.</p>
            </div>
        </div>
    </div>
</section>
@endsection