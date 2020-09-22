<?php

namespace PrestaShop\Module\TextTranslate\Service;

use Doctrine\Orm\EntityManager;
use Exception;
use PrestaShop\Module\TextTranslate\Entity\TabLangCollection;
use PrestaShopBundle\Entity\Repository\LangRepository;
use PrestaShopBundle\Entity\Repository\TabLangRepository;
use PrestaShopBundle\Entity\Repository\TranslationRepository;
use PrestaShopBundle\Entity\TabLang;
use PrestaShopBundle\Entity\Translation;

/**
 * TranslateService class
 */
class TranslateService {

    /** @var EntityManager */
    private $em;

    /** @var TabLangRepository */
    private $tabLangRepository;

    /** @var TranslationRepository */
    private $translationRepository;

    /** @var LangRepository */
    private $langRepository;

    /**
     * Undocumented function
     *
     * @param EntityManager $em
     * @param TabLangRepository $tabLangRepository
     * @param TranslationRepository $translationRepository
     * @param LangRepository $langRepository
     */
    public function __construct(
        EntityManager $em,
        TabLangRepository $tabLangRepository,
        TranslationRepository $translationRepository,
        LangRepository $langRepository) {
        $this->em = $em;
        $this->tabLangRepository = $tabLangRepository;
        $this->translationRepository = $translationRepository;
        $this->langRepository = $langRepository;
    }
    /**
     * Get tablang list
     *
     * @return void
     */
    public function getTabLangList(){
        return $this->tabLangRepository->findAll();
    }
    /**
     * Undocumented function
     *
     * @param TabLangCollection $tbCo
     * @return void
     */
    public function update(TabLangCollection $tbCo){
        foreach ($tbCo->getTablangs() as $tablang) {
            $this->em->persist($tablang);
        }
        foreach ($tbCo->getTranslations() as $trans) {
            $this->em->persist($trans);
        }
        $this->em->flush();
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCustomeTranslationList(){
        return $this->translationRepository->findAll();
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getLangs(){
        return $this->langRepository->findAll();
    }
    /**
     * Undocumented function
     *
     * @param TabLang $tabLang
     * @return void
     */
    public function addTabLang(TabLang $tabLang){
        $this->em->persist($tabLang);
        $this->em->flush();
    }
    /**
     * Undocumented function
     *
     * @param Translation $tabLang
     * @return void
     */
    public function addTranslation(Translation $tabLang){
        $this->em->persist($tabLang);
        $this->em->flush();
    }
    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function deleteTranslation(int $id){
        $translation = $this->translationRepository->findOneBy(['id' => $id]);
        if ($translation) {
            $this->em->remove($translation);
            $this->em->flush();
        } else {
            throw new Exception("No found translation");
        }

    }

}